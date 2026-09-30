<?php

namespace App\Http\Controllers;

use App\Mail\NewBookingNotification;
use App\Models\Booking;
use App\Models\ContactInquiry;
use App\Models\Gallery;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\WebsiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('activeServices')->where('is_active', true)->orderBy('sort_order')->get();
        $featuredServices = Service::where('is_active', true)->where('is_featured', true)->take(6)->get();
        $websiteServices = WebsiteService::where('is_active', true)->orderBy('sort_order')->get();
        $gallery = Gallery::where('is_active', true)->orderBy('sort_order')->take(8)->get();
        $reviews = Review::where('is_approved', true)->orderBy('sort_order')->take(6)->get();

        return view('frontend.index', compact('categories', 'featuredServices', 'websiteServices', 'gallery', 'reviews'));
    }

    public function about()
    {
        $gallery = Gallery::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.about', compact('gallery'));
    }

    public function services()
    {
        $categories = ServiceCategory::with('activeServices')->where('is_active', true)->orderBy('sort_order')->get();
        $websiteServices = WebsiteService::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.services', compact('categories', 'websiteServices'));
    }

    public function booking(Request $request)
    {
        $categories = ServiceCategory::with([
            'activeServices',
            'galleryImages' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')
        ])->where('is_active', true)->orderBy('sort_order')->get();
        $selectedServiceId = $request->query('service_id');
        $selectedService = $selectedServiceId ? Service::find($selectedServiceId) : null;

        return view('frontend.booking', compact('categories', 'selectedService'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'service_name' => 'required|string|max:255',
            'hair_length_option' => 'nullable|string|max:100',
            'hair_size_option' => 'nullable|string|max:100',
            'gel_preference' => 'required|in:gel,no_gel,undecided',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string|max:50',
            'service_location_type' => 'required|in:mobile_home,travel,salon_studio',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:50',
            'total_price' => 'required|numeric|min:0',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
            'client_notes' => 'nullable|string|max:1000',
            'policies_agreed' => 'required|accepted',
        ]);

        $service = null;
        if (!empty($validated['service_id'])) {
            $service = Service::with('category')->find($validated['service_id']);
        }

        $totalPrice = (float)$validated['total_price'];
        $depositPercentage = 30.0;
        $depositAmount = round(($totalPrice * $depositPercentage) / 100, 2);
        $balanceAmount = max(0, $totalPrice - $depositAmount);

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $paymentProofPath = '/storage/' . $path;
        }

        $bookingRef = 'EB-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $booking = Booking::create([
            'booking_reference' => $bookingRef,
            'user_id' => auth()->id() ?? null,
            'service_id' => $service?->id,
            'service_name' => $service ? $service->name : $validated['service_name'],
            'category_name' => $service?->category?->name ?? 'Braiding Service',
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'service_location_type' => $validated['service_location_type'],
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? 'Luton',
            'postcode' => $validated['postcode'] ?? null,
            'gel_preference' => $validated['gel_preference'],
            'hair_length_option' => $validated['hair_length_option'] ?? null,
            'hair_size_option' => $validated['hair_size_option'] ?? null,
            'total_price' => $totalPrice,
            'deposit_amount' => $depositAmount,
            'deposit_status' => $paymentProofPath ? 'pending' : 'pending',
            'balance_amount' => $balanceAmount,
            'balance_status' => 'pending',
            'status' => 'pending',
            'payment_method' => 'revolut_transfer',
            'payment_reference' => $bookingRef,
            'payment_proof' => $paymentProofPath,
            'client_notes' => $validated['client_notes'] ?? null,
            'policies_accepted' => true,
        ]);

        // Send Email Notification to Administrators
        try {
            Mail::to(['fasanyafemi@gmail.com', 'prettytoll@gmail.com'])->send(new NewBookingNotification($booking));
        } catch (\Exception $e) {
            Log::error('New booking notification email error: ' . $e->getMessage());
        }

        return redirect()->route('booking.confirmation', ['reference' => $booking->booking_reference])
            ->with('success', 'Your appointment request has been submitted successfully! Please review the deposit payment details below.');
    }

    public function uploadPaymentProof(Request $request, $reference)
    {
        $booking = Booking::where('booking_reference', $reference)->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');
        $booking->payment_proof = '/storage/' . $path;
        $booking->save();



        return redirect()->route('booking.confirmation', ['reference' => $booking->booking_reference])
            ->with('success', 'Payment proof screenshot uploaded successfully! Our team is reviewing and will confirm your booking shortly.');
    }

    public function bookingConfirmation($reference)
    {
        $booking = Booking::where('booking_reference', $reference)->firstOrFail();
        return view('frontend.booking-confirmation', compact('booking'));
    }

    public function portfolio()
    {
        $gallery = Gallery::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.portfolio', compact('gallery'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create($validated);

        return back()->with('success', 'Thank you for reaching out to Ella Beauty! We will respond to your message promptly.');
    }
}
