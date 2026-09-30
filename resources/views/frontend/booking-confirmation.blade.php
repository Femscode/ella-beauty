@extends('frontend.master')

@section('title', 'Booking Confirmation #' . $booking->booking_reference . ' | Ella Beauty')

@section('content')
<section style="padding: 140px 0 80px; background: linear-gradient(180deg, #F0F9FF 0%, #FFFFFF 100%); min-height: 85vh;">
    <div class="container" style="max-width: 850px; margin: 0 auto; padding: 0 20px;">

        @if(session('success'))
            <div style="background: #ECFDF5; border: 1.5px solid #6EE7B7; color: #065F46; padding: 16px 20px; border-radius: 12px; font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.2rem;">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header confirmation badge -->
        <div style="text-align: center; margin-bottom: 36px;">
            <div style="width: 72px; height: 72px; background: linear-gradient(135deg, #10B981 0%, #059669 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #FFFFFF; margin-bottom: 20px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <span style="display: block; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #0284C7; margin-bottom: 8px;">Booking Request Received</span>
            <h1 style="font-family: var(--font-heading, 'Montserrat', sans-serif); font-size: 2.2rem; color: #160D4A; margin-bottom: 12px; font-weight: 800;">Appointment Reference: <span style="color: #271875;">#{{ $booking->booking_reference }}</span></h1>
            <p style="color: #475569; font-size: 1.05rem; max-width: 580px; margin: 0 auto; line-height: 1.6;">
                Thank you, <strong>{{ $booking->client_name }}</strong>! Your appointment has been logged. Please ensure your 30% deposit is transferred to the Revolut account below to guarantee your slot.
            </p>
        </div>

        <!-- 30% Deposit & Revolut Transfer Box -->
        <div style="background: #FFFFFF; border-radius: 16px; border: 2px solid #BAE6FD; padding: 28px; box-shadow: 0 10px 30px rgba(39, 24, 117, 0.08); margin-bottom: 32px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; width: 6px; height: 100%; background: #0284C7;"></div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 20px;">
                <div>
                    <span style="font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #D97706; background: #FEF3C7; padding: 4px 10px; border-radius: 20px;">Deposit Payment</span>
                    <h3 style="font-size: 1.4rem; color: #160D4A; font-weight: 800; margin-top: 8px;">30% Deposit Due: £{{ number_format($booking->deposit_amount, 2) }}</h3>
                    <p style="color: #64748B; font-size: 0.92rem; margin-top: 4px;">Total Fee: £{{ number_format($booking->total_price, 2) }} • 70% Balance £{{ number_format($booking->balance_amount, 2) }} due on appointment day</p>
                </div>
                <div>
                    @if($booking->deposit_status === 'paid')
                        <span style="display: inline-block; padding: 6px 14px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; background: #DCFCE7; color: #15803D;">Deposit Status: Confirmed Paid ✓</span>
                    @else
                        <span style="display: inline-block; padding: 6px 14px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; background: #FEF3C7; color: #B45309;">Deposit Status: Awaiting Verification</span>
                    @endif
                </div>
            </div>

            <!-- Revolut Account Card -->
            <div style="background: #F8FAFC; border: 1.5px solid #E2E8F0; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px dashed #CBD5E1;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #000; color: #FFF; font-weight: 900; font-size: 1.1rem; display: flex; align-items: center; justify-content: center;">R</div>
                        <div>
                            <div style="font-size: 0.75rem; color: #64748B; font-weight: 700; text-transform: uppercase;">Bank Transfer Details</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #160D4A;">Revolut</div>
                        </div>
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 800; color: #059669; background: #ECFDF5; padding: 3px 8px; border-radius: 12px; border: 1px solid #A7F3D0;">Verified Account</span>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; font-size: 0.92rem;">
                    <div style="background: #FFF; padding: 10px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <span style="color: #64748B; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 2px;">Account Name</span>
                        <strong style="color: #0F172A;">Toluwalope Ajala</strong>
                    </div>
                    <div style="background: #FFF; padding: 10px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <span style="color: #64748B; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 2px;">Sort Code</span>
                        <strong style="color: #0F172A; font-family: monospace; font-size: 1rem;">23-01-20</strong>
                    </div>
                    <div style="background: #FFF; padding: 10px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <span style="color: #64748B; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 2px;">Account Number</span>
                        <strong style="color: #0F172A; font-family: monospace; font-size: 1rem;">56933694</strong>
                    </div>
                </div>

                <div style="margin-top: 12px; font-size: 0.82rem; color: #92400E; background: #FEF3C7; padding: 8px 12px; border-radius: 6px;">
                    💡 <strong>Payment Reference:</strong> Please use <strong>{{ $booking->client_name }}</strong> or <strong>{{ $booking->booking_reference }}</strong> as your payment reference.
                </div>
            </div>

            <!-- Proof of Payment Status / Upload Form -->
            @if($booking->payment_proof)
                <div style="background: #F0FDF4; border: 1.5px solid #86EFAC; border-radius: 12px; padding: 18px 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 2rem;">📸</span>
                        <div>
                            <strong style="color: #14532D; font-size: 0.95rem; display: block;">Payment Proof Screenshot Attached</strong>
                            <span style="color: #15803D; font-size: 0.85rem;">Our team is reviewing your proof and will verify your booking.</span>
                        </div>
                    </div>
                    <a href="{{ url($booking->payment_proof) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #15803D; color: #FFF; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                        <span>View Uploaded Proof</span> ↗
                    </a>
                </div>
            @else
                <div style="background: #FFFBEB; border: 1.5px dashed #F59E0B; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
                    <h4 style="font-size: 1rem; color: #92400E; margin: 0 0 6px; font-weight: 800;">Upload Payment Screenshot (Optional but recommended)</h4>
                    <p style="font-size: 0.88rem; color: #B45309; margin: 0 0 14px;">Already transferred the £{{ number_format($booking->deposit_amount, 2) }} deposit? Attach your receipt screenshot below for prompt verification:</p>
                    
                    <form action="{{ route('booking.upload-proof', ['reference' => $booking->booking_reference]) }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                        @csrf
                        <input type="file" name="payment_proof" accept="image/*,application/pdf" required style="flex: 1; padding: 8px 12px; background: #FFF; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 0.85rem;">
                        <button type="submit" style="padding: 10px 20px; background: #0284C7; color: #FFF; border: none; border-radius: 8px; font-weight: 700; font-size: 0.88rem; cursor: pointer;">Upload Proof</button>
                    </form>
                </div>
            @endif

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="https://wa.me/447350166691?text={{ urlencode("Hello Ella Beauty! I have booked an appointment.\nReference: #" . $booking->booking_reference . "\nStyle: " . $booking->service_name . "\nDate: " . \Carbon\Carbon::parse($booking->appointment_date)->format('d/m/Y') . " at " . $booking->appointment_time . "\nDeposit: £" . number_format($booking->deposit_amount, 2) . "\nI have made the transfer to Revolut.") }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #25D366; color: #FFFFFF; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 0.95rem; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);">
                    <span>Send Message on WhatsApp</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Appointment Summary Card -->
        <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid #E2E8F0; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); margin-bottom: 32px;">
            <h3 style="font-size: 1.2rem; color: #160D4A; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">Appointment Summary</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; font-size: 0.92rem;">
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Hairstyle</span>
                    <div style="color: #160D4A; font-weight: 700; font-size: 1.05rem; margin-top: 3px;">{{ $booking->service_name }}</div>
                </div>
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Gel Preference</span>
                    <div style="color: #160D4A; font-weight: 600; margin-top: 3px;">{{ ucfirst(str_replace('_', ' ', $booking->gel_preference)) }}</div>
                </div>
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Appointment Date</span>
                    <div style="color: #0284C7; font-weight: 700; font-size: 1.05rem; margin-top: 3px;">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, d M Y') }}</div>
                </div>
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Time Slot</span>
                    <div style="color: #0284C7; font-weight: 700; font-size: 1.05rem; margin-top: 3px;">{{ $booking->appointment_time }}</div>
                </div>
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Service Type</span>
                    <div style="color: #160D4A; font-weight: 600; margin-top: 3px; text-transform: capitalize;">{{ str_replace('_', ' ', $booking->service_location_type) }}</div>
                </div>
                <div>
                    <span style="color: #64748B; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Client Contact</span>
                    <div style="color: #160D4A; font-weight: 600; margin-top: 3px;">{{ $booking->client_name }} ({{ $booking->client_phone }})</div>
                </div>
            </div>

            @if($booking->address)
            <div style="margin-top: 18px; padding-top: 14px; border-top: 1px dashed #E2E8F0; font-size: 0.9rem; color: #475569;">
                <strong>Service Address:</strong> {{ $booking->address }}, {{ $booking->city }} {{ $booking->postcode }}
            </div>
            @endif
        </div>

        <!-- Back to Home -->
        <div style="text-align: center;">
            <a href="{{ route('home') }}" style="color: #0284C7; text-decoration: none; font-weight: 600; font-size: 0.95rem;">← Return to Ella Beauty Homepage</a>
        </div>
    </div>
</section>
@endsection