<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('deposit_status')) {
            $query->where('deposit_status', $request->deposit_status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%")
                    ->orWhere('client_phone', 'like', "%{$search}%")
                    ->orWhere('service_name', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'stats'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        return view('admin.bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'service_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string|max:50',
            'service_location_type' => 'required|in:mobile_home,travel,salon_studio',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:50',
            'gel_preference' => 'required|in:gel,no_gel,undecided',
            'hair_length_option' => 'nullable|string|max:100',
            'hair_size_option' => 'nullable|string|max:100',
            'total_price' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0',
            'deposit_status' => 'required|in:pending,paid,refunded,waived',
            'balance_status' => 'required|in:pending,paid',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled,rescheduled',
            'admin_notes' => 'nullable|string',
        ]);

        $validated['balance_amount'] = max(0, $validated['total_price'] - $validated['deposit_amount']);

        $booking = Booking::create($validated);

        return redirect()->route('admin.bookings.show', $booking)->with('success', 'Booking created successfully!');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'nullable|in:pending,confirmed,in_progress,completed,cancelled,rescheduled',
            'deposit_status' => 'nullable|in:pending,paid,refunded,waived',
            'balance_status' => 'nullable|in:pending,paid',
            'admin_notes' => 'nullable|string',
        ]);

        $booking->update(array_filter($validated, fn($val) => !is_null($val)));

        return back()->with('success', 'Booking status updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
