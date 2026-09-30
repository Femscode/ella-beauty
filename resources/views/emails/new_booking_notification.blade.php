<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Received - Ella Beauty</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #F1F5F9;
            margin: 0;
            padding: 24px 12px;
            color: #1E293B;
        }
        .email-container {
            max-width: 620px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #E2E8F0;
        }
        .email-header {
            background: linear-gradient(135deg, #0B0626 0%, #160D4A 60%, #271875 100%);
            padding: 32px 24px;
            text-align: center;
            color: #FFFFFF;
        }
        .brand-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.05em;
            margin: 0 0 6px;
            color: #FFFFFF;
        }
        .brand-subtitle {
            font-size: 13px;
            color: #38BDF8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin: 0;
        }
        .email-body {
            padding: 28px 24px;
        }
        .badge-alert {
            display: inline-block;
            background: #E0F2FE;
            color: #0284C7;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        h2 {
            font-size: 20px;
            color: #0F172A;
            margin: 0 0 12px;
            font-weight: 800;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
            color: #475569;
            margin: 0 0 18px;
        }
        .detail-box {
            background: #F8FAFC;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            padding: 18px 20px;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #EDF2F7;
            font-size: 14px;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #64748B;
            font-weight: 600;
            width: 40%;
        }
        .detail-value {
            color: #0F172A;
            font-weight: 700;
            text-align: right;
            width: 60%;
        }
        .financial-summary {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
        }
        .financial-summary .amount-due {
            font-size: 18px;
            color: #15803D;
            font-weight: 800;
        }
        .proof-box {
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            font-size: 13.5px;
            color: #92400E;
        }
        .btn-cta {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #0284C7 0%, #2563EB 100%);
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 24px;
            border-radius: 10px;
            text-decoration: none;
            margin: 24px 0 12px;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
        }
        .email-footer {
            background: #F8FAFC;
            border-top: 1px solid #E2E8F0;
            padding: 20px 24px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="brand-title">ELLA BEAUTY ✨</div>
            <div class="brand-subtitle">Hair for Queens • Luton & Surrounding</div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <span class="badge-alert">New Appointment Request</span>
            <h2>Booking Reference: #{{ $booking->booking_reference }}</h2>
            <p>
                A new appointment booking has just been submitted on Ella Beauty. Below are the complete appointment and client payment details:
            </p>

            <!-- Client Profile -->
            <div class="detail-box">
                <div class="detail-row">
                    <span class="detail-label">Client Name:</span>
                    <span class="detail-value">{{ $booking->client_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Client Email:</span>
                    <span class="detail-value"><a href="mailto:{{ $booking->client_email }}" style="color: #0284C7;">{{ $booking->client_email }}</a></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone / WhatsApp:</span>
                    <span class="detail-value"><a href="tel:{{ $booking->client_phone }}" style="color: #0284C7;">{{ $booking->client_phone }}</a></span>
                </div>
            </div>

            <!-- Hairstyle & Schedule Details -->
            <div class="detail-box">
                <div class="detail-row">
                    <span class="detail-label">Hairstyle / Service:</span>
                    <span class="detail-value" style="color: #160D4A;">{{ $booking->service_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Date:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, d M Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Time Slot:</span>
                    <span class="detail-value">{{ $booking->appointment_time }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Location Format:</span>
                    <span class="detail-value" style="text-transform: capitalize;">{{ str_replace('_', ' ', $booking->service_location_type ?? 'mobile_home') }}</span>
                </div>
                @if($booking->address)
                <div class="detail-row">
                    <span class="detail-label">Address / Postcode:</span>
                    <span class="detail-value">{{ $booking->address }}, {{ $booking->city }} {{ $booking->postcode }}</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Gel Preference:</span>
                    <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $booking->gel_preference ?? 'undecided')) }}</span>
                </div>
                @if($booking->hair_length_option)
                <div class="detail-row">
                    <span class="detail-label">Length & Size:</span>
                    <span class="detail-value">{{ $booking->hair_length_option }} {{ $booking->hair_size_option ? '• ' . $booking->hair_size_option : '' }}</span>
                </div>
                @endif
                @if($booking->client_notes)
                <div class="detail-row">
                    <span class="detail-label">Client Notes:</span>
                    <span class="detail-value" style="font-weight: 500; font-style: italic;">"{{ $booking->client_notes }}"</span>
                </div>
                @endif
            </div>

            <!-- Financials -->
            <div class="financial-summary">
                <div class="detail-row" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                    <span class="detail-label" style="color: #1E293B;">Total Price:</span>
                    <span class="detail-value" style="color: #1E293B;">£{{ number_format($booking->total_price, 2) }}</span>
                </div>
                <div class="detail-row" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                    <span class="detail-label" style="color: #15803D;">30% Deposit Due:</span>
                    <span class="detail-value amount-due">£{{ number_format($booking->deposit_amount, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label" style="color: #64748B;">70% Balance on Day:</span>
                    <span class="detail-value" style="color: #64748B;">£{{ number_format($booking->balance_amount, 2) }}</span>
                </div>
            </div>

            <!-- Payment Proof Status -->
            @if($booking->payment_proof)
            <div class="proof-box" style="background: #ECFDF5; border-color: #A7F3D0; color: #065F46;">
                <strong>📸 Payment Screenshot Uploaded:</strong><br>
                The client attached proof of transfer. You can review the attached image in the admin panel or direct link below:<br>
                <a href="{{ $booking->payment_proof_url }}" target="_blank" style="display: inline-block; margin-top: 8px; font-weight: 700; color: #047857;">👉 Click to View Payment Screenshot</a>
            </div>
            @else
            <div class="proof-box">
                <strong>⏳ Payment Screenshot:</strong><br>
                The client has not yet uploaded a receipt screenshot online. Please confirm bank credit to Revolut (Acct: 56933694).
            </div>
            @endif

            <!-- Action Button -->
            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn-cta">
                View & Manage Booking in Admin Dashboard →
            </a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 6px;">© 2026 Ella Beauty. All rights reserved.</p>
            <p style="margin: 0;">Automated booking notification dispatched to administrators.</p>
        </div>
    </div>
</body>
</html>
