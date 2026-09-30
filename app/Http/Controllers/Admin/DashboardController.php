<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactInquiry;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        
        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $depositsCollected = Booking::where('deposit_status', 'paid')->sum('deposit_amount');
        $pendingDeposits = Booking::where('deposit_status', 'pending')->sum('deposit_amount');

        $totalServices = Service::where('is_active', true)->count();
        $totalClients = User::where('role', '!=', 'admin')->count();
        $newInquiries = ContactInquiry::where('status', 'new')->count();

        $recentBookings = Booking::latest()->take(8)->get();
        $upcomingAppointments = Booking::whereIn('status', ['confirmed', 'pending'])
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'totalRevenue',
            'depositsCollected',
            'pendingDeposits',
            'totalServices',
            'totalClients',
            'newInquiries',
            'recentBookings',
            'upcomingAppointments'
        ));
    }
}
