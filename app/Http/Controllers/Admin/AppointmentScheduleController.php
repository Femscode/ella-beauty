<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UnavailableDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AppointmentScheduleController extends Controller
{
    public function index(Request $request)
    {
        $year = (int) ($request->get('year', now()->year));
        $month = (int) ($request->get('month', now()->month));

        // Validate range bounds
        if ($month < 1) {
            $month = 12;
            $year--;
        } elseif ($month > 12) {
            $month = 1;
            $year++;
        }

        $currentMonthDate = Carbon::createFromDate($year, $month, 1);
        $prevMonthDate = (clone $currentMonthDate)->subMonth();
        $nextMonthDate = (clone $currentMonthDate)->addMonth();

        $startOfMonth = (clone $currentMonthDate)->startOfMonth();
        $endOfMonth = (clone $currentMonthDate)->endOfMonth();

        // Fetch bookings for this month
        $bookings = Booking::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
            ->orderBy('appointment_time')
            ->get();

        $bookingsByDate = [];
        foreach ($bookings as $booking) {
            $d = is_string($booking->appointment_date) ? substr($booking->appointment_date, 0, 10) : $booking->appointment_date->format('Y-m-d');
            $bookingsByDate[$d][] = $booking;
        }

        // Fetch blocked / unavailable dates for this month
        $unavailableDates = UnavailableDate::whereBetween('date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
            ->get()
            ->keyBy(fn($item) => $item->date->format('Y-m-d'));

        // Fetch all upcoming unavailable dates for quick management list
        $upcomingUnavailable = UnavailableDate::whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        // Calendar Grid Calculations
        // Carbon dayOfWeek: 0 = Sunday, 1 = Monday, ... 6 = Saturday
        // We will display Monday as first day of week (1=Mon ... 7=Sun)
        $firstDayOfWeek = $startOfMonth->dayOfWeekIso; // 1 (Mon) to 7 (Sun)
        $daysInMonth = $startOfMonth->daysInMonth;

        // Calculate leading blank / padding days before day 1
        $paddingDays = $firstDayOfWeek - 1;

        // Statistics
        $stats = [
            'total_this_month' => $bookings->count(),
            'confirmed_this_month' => $bookings->where('status', 'confirmed')->count(),
            'pending_this_month' => $bookings->where('status', 'pending')->count(),
            'unavailable_days_this_month' => $unavailableDates->count(),
            'total_upcoming_unavailable' => $upcomingUnavailable->count(),
        ];

        return view('admin.appointments.index', compact(
            'year',
            'month',
            'currentMonthDate',
            'prevMonthDate',
            'nextMonthDate',
            'daysInMonth',
            'paddingDays',
            'bookingsByDate',
            'unavailableDates',
            'upcomingUnavailable',
            'stats'
        ));
    }

    public function storeUnavailable(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $reason = $validated['reason'] ?? 'Unavailable / Off';
        $notes = $validated['notes'] ?? null;

        if (!empty($validated['end_date']) && $validated['end_date'] !== $validated['date']) {
            $period = CarbonPeriod::create($validated['date'], $validated['end_date']);
            foreach ($period as $dt) {
                UnavailableDate::updateOrCreate(
                    ['date' => $dt->format('Y-m-d')],
                    [
                        'reason' => $reason,
                        'notes' => $notes,
                        'all_day' => true,
                    ]
                );
            }
            return back()->with('success', "Dates from {$validated['date']} to {$validated['end_date']} have been marked as unavailable.");
        } else {
            UnavailableDate::updateOrCreate(
                ['date' => $validated['date']],
                [
                    'reason' => $reason,
                    'notes' => $notes,
                    'all_day' => true,
                ]
            );
            return back()->with('success', "Date {$validated['date']} has been marked as unavailable.");
        }
    }

    public function destroyUnavailable(UnavailableDate $unavailableDate)
    {
        $dateStr = $unavailableDate->date->format('Y-m-d');
        $unavailableDate->delete();

        return back()->with('success', "Date {$dateStr} has been unblocked and is now open for bookings.");
    }
}
