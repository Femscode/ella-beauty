@extends('admin.layout')

@section('title', 'Booking #' . $booking->booking_reference)
@section('header_title', 'Booking Reference: ' . $booking->booking_reference)

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">← Back to All Bookings</a>
</div>

<div class="adm-grid-2">
    <!-- Left Column: Appointment & Client Information -->
    <div>
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Client & Contact Profile</div>
                <span class="status-pill status-{{ $booking->status }}">{{ $booking->status }}</span>
            </div>
            <div class="adm-card-body">
                <table class="adm-table" style="margin: 0;">
                    <tbody>
                        <tr>
                            <td style="width: 35%; font-weight: 600; color: var(--adm-text-muted);">Client Full Name</td>
                            <td><strong>{{ $booking->client_name }}</strong></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Email Address</td>
                            <td><a href="mailto:{{ $booking->client_email }}" style="color: var(--adm-accent-dark);">{{ $booking->client_email }}</a></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Phone / WhatsApp</td>
                            <td><a href="tel:{{ $booking->client_phone }}" style="color: var(--adm-accent-dark); font-weight: 600;">{{ $booking->client_phone }}</a></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Booking Created</td>
                            <td>{{ $booking->created_at->format('d M Y, h:i A') }} ({{ $booking->created_at->diffForHumans() }})</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Hairstyle & Appointment Logistics</div>
            </div>
            <div class="adm-card-body">
                <table class="adm-table" style="margin: 0;">
                    <tbody>
                        <tr>
                            <td style="width: 35%; font-weight: 600; color: var(--adm-text-muted);">Selected Hairstyle</td>
                            <td><strong style="color: var(--adm-primary-dark); font-size: 1rem;">{{ $booking->service_name }}</strong></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Category</td>
                            <td>{{ $booking->category_name ?? 'Protective Braids' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Gel Preference</td>
                            <td>
                                <strong style="color: {{ $booking->gel_preference === 'gel' ? 'var(--adm-primary)' : 'var(--adm-gold)' }};">
                                    {{ ucfirst(str_replace('_', ' ', $booking->gel_preference)) }}
                                </strong>
                            </td>
                        </tr>
                        @if($booking->hair_length_option)
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Length / Size</td>
                            <td>{{ $booking->hair_length_option }} {{ $booking->hair_size_option ? '• ' . $booking->hair_size_option : '' }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Appointment Date</td>
                            <td><strong style="color: var(--adm-accent-dark); font-size: 1.05rem;">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, d F Y') }}</strong></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Appointment Time</td>
                            <td><strong style="color: var(--adm-accent-dark); font-size: 1.05rem;">{{ $booking->appointment_time }}</strong></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Service Format</td>
                            <td><span style="text-transform: capitalize;">{{ str_replace('_', ' ', $booking->service_location_type) }}</span></td>
                        </tr>
                        @if($booking->address)
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Location Address</td>
                            <td>{{ $booking->address }}, {{ $booking->city }} {{ $booking->postcode }}</td>
                        </tr>
                        @endif
                        @if($booking->client_notes)
                        <tr>
                            <td style="font-weight: 600; color: var(--adm-text-muted);">Client Notes</td>
                            <td><div style="background: #F8FAFC; padding: 10px; border-radius: 6px; font-style: italic;">"{{ $booking->client_notes }}"</div></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Financial Breakdown & Update Controls -->
    <div>
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Financial Breakdown & 30% Deposit</div>
            </div>
            <div class="adm-card-body">
                <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid var(--adm-border);">
                        <span>Total Hairstyle Fee</span>
                        <span style="font-size: 1.15rem; font-weight: 700;">£{{ number_format($booking->total_price, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid var(--adm-border);">
                        <div>
                            <span>Required 30% Deposit</span>
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted);">To secure & confirm appointment</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 1.15rem; font-weight: 700; color: var(--adm-accent-dark);">£{{ number_format($booking->deposit_amount, 2) }}</span>
                            <div><span class="status-pill status-{{ $booking->deposit_status === 'paid' ? 'paid' : 'unpaid' }}">{{ $booking->deposit_status }}</span></div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-bottom: 10px;">
                        <div>
                            <span>Remaining 70% Balance</span>
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted);">Due according to booking policies</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 1.15rem; font-weight: 700;">£{{ number_format($booking->balance_amount, 2) }}</span>
                            <div><span class="status-pill status-{{ $booking->balance_status === 'paid' ? 'paid' : 'unpaid' }}">{{ $booking->balance_status }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Proof Screenshot Card -->
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">📸 Payment Proof Screenshot</div>
                @if($booking->payment_proof)
                    <span class="status-pill status-paid">Proof Uploaded</span>
                @else
                    <span class="status-pill status-unpaid">No Proof Attached</span>
                @endif
            </div>
            <div class="adm-card-body">
                @if($booking->payment_proof)
                    @php
                        $ext = pathinfo($booking->payment_proof, PATHINFO_EXTENSION);
                        $isPdf = strtolower($ext) === 'pdf';
                    @endphp
                    @if($isPdf)
                        <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 10px; border: 1px dashed #CBD5E1;">
                            <div style="font-size: 2.5rem; margin-bottom: 8px;">📄</div>
                            <div style="font-weight: 700; color: #1E293B; margin-bottom: 12px;">PDF Document Attached</div>
                            <a href="{{ $booking->payment_proof_url }}" target="_blank" class="adm-btn adm-btn-primary adm-btn-sm">
                                View / Download PDF Receipt ↗
                            </a>
                        </div>
                    @else
                        <div style="border-radius: 10px; overflow: hidden; border: 1px solid var(--adm-border); background: #000; text-align: center; position: relative;">
                            <a href="{{ $booking->payment_proof_url }}" target="_blank" title="Click to view full image">
                                <img src="{{ $booking->payment_proof_url }}" alt="Proof of Payment" style="width: 100%; max-height: 280px; object-fit: contain; display: block; margin: 0 auto;">
                            </a>
                        </div>
                        <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.8rem; color: var(--adm-text-muted);">Transferred to Revolut (56933694)</span>
                            <a href="{{ $booking->payment_proof_url }}" target="_blank" class="adm-btn adm-btn-outline adm-btn-sm">
                                Open Full Size ↗
                            </a>
                        </div>
                    @endif
                @else
                    <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 10px; color: var(--adm-text-muted); font-size: 0.88rem;">
                        No screenshot was attached during booking.<br>
                        Verify direct transfer in your Revolut app with client name <strong>{{ $booking->client_name }}</strong> or ref <strong>#{{ $booking->booking_reference }}</strong>.
                    </div>
                @endif
            </div>
        </div>

        <!-- Manage Booking Status & Admin Action Form -->
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Update Appointment Status</div>
            </div>
            <div class="adm-card-body">
                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="adm-form-group">
                        <label class="adm-form-label">Booking Status</label>
                        <select name="status" class="adm-form-control">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending (Awaiting Deposit Confirmation)</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed (Slot Secured)</option>
                            <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress (Styling Session)</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed (Done)</option>
                            <option value="rescheduled" {{ $booking->status == 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="adm-grid-2">
                        <div class="adm-form-group">
                            <label class="adm-form-label">Deposit Status (30%)</label>
                            <select name="deposit_status" class="adm-form-control">
                                <option value="pending" {{ $booking->deposit_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->deposit_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="refunded" {{ $booking->deposit_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                <option value="waived" {{ $booking->deposit_status == 'waived' ? 'selected' : '' }}>Waived</option>
                            </select>
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-form-label">70% Balance Status</label>
                            <select name="balance_status" class="adm-form-control">
                                <option value="pending" {{ $booking->balance_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->balance_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-form-label">Admin Notes (Internal Staff Notes)</label>
                        <textarea name="admin_notes" class="adm-form-control" placeholder="Internal communication, custom hair extensions instructions, travel fee notes, etc.">{{ $booking->admin_notes }}</textarea>
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <button type="submit" class="adm-btn adm-btn-primary" style="flex: 1;">Save Changes</button>
                    </div>
                </form>

                <hr style="margin: 24px 0; border: none; border-top: 1px solid var(--adm-border);">

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->client_phone) }}?text=Hello%20{{ urlencode($booking->client_name) }},%20this%20is%20Ella%20Beauty%20regarding%20your%20appointment%20({{ $booking->booking_reference }})%20for%20{{ urlencode($booking->service_name) }}." target="_blank" class="adm-btn adm-btn-accent adm-btn-sm">
                        💬 Open WhatsApp Chat
                    </a>

                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this booking record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
