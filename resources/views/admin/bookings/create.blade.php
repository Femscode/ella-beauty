@extends('admin.layout')

@section('title', 'Create Manual Booking')
@section('header_title', 'Create Manual Booking / Appointment')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">← Back to All Bookings</a>
</div>

<div class="adm-card" style="max-width: 900px; margin: 0 auto;">
    <div class="adm-card-header">
        <div class="adm-card-title">New Client Booking Form</div>
    </div>
    <div class="adm-card-body">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin-bottom: 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">1. Client Information</h3>
            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Client Name *</label>
                    <input type="text" name="client_name" class="adm-form-control" required value="{{ old('client_name') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Email Address *</label>
                    <input type="email" name="client_email" class="adm-form-control" required value="{{ old('client_email') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Phone / WhatsApp *</label>
                    <input type="text" name="client_phone" class="adm-form-control" required value="{{ old('client_phone') }}" placeholder="+44...">
                </div>
            </div>

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin: 20px 0 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">2. Hairstyle & Specifications</h3>
            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Select Preset Hairstyle</label>
                    <select id="serviceSelect" name="service_id" class="adm-form-control">
                        <option value="">-- Choose from Catalog or Type Below --</option>
                        @foreach($services as $serv)
                        <option value="{{ $serv->id }}" data-price="{{ $serv->price }}" data-name="{{ $serv->name }}">
                            {{ $serv->name }} (£{{ number_format($serv->price, 2) }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Service Title (Custom or Preset) *</label>
                    <input type="text" id="serviceName" name="service_name" class="adm-form-control" required value="{{ old('service_name') }}">
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Gel Preference *</label>
                    <select name="gel_preference" class="adm-form-control" required>
                        <option value="gel">With Gel (Laid & Defined Finish)</option>
                        <option value="no_gel">No Gel (Gel-Free Natural)</option>
                        <option value="undecided">Undecided / Discuss</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Length Option</label>
                    <input type="text" name="hair_length_option" class="adm-form-control" placeholder="e.g. Mid-back, Waist length" value="{{ old('hair_length_option') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Size Option</label>
                    <input type="text" name="hair_size_option" class="adm-form-control" placeholder="e.g. Small, Smedium, Medium" value="{{ old('hair_size_option') }}">
                </div>
            </div>

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin: 20px 0 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">3. Schedule & Location</h3>
            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Appointment Date *</label>
                    <input type="date" name="appointment_date" class="adm-form-control" required value="{{ old('appointment_date', date('Y-m-d')) }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Appointment Time *</label>
                    <input type="text" name="appointment_time" class="adm-form-control" required value="{{ old('appointment_time', '10:00 AM') }}" placeholder="e.g. 10:00 AM">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Location Type *</label>
                    <select name="service_location_type" class="adm-form-control" required>
                        <option value="mobile_home">Mobile / Home Service (Luton)</option>
                        <option value="travel">Travel Appointment (Selected locations)</option>
                        <option value="salon_studio">Home Salon</option>
                    </select>
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group" style="grid-column: span 2;">
                    <label class="adm-form-label">Street Address</label>
                    <input type="text" name="address" class="adm-form-control" placeholder="House number & street name" value="{{ old('address') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">City / Postcode</label>
                    <input type="text" name="city" class="adm-form-control" placeholder="Luton" value="{{ old('city', 'Luton') }}">
                </div>
            </div>

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin: 20px 0 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">4. Pricing & Status</h3>
            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Total Service Price (£) *</label>
                    <input type="number" step="0.01" id="totalPrice" name="total_price" class="adm-form-control" required value="{{ old('total_price', '120.00') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">30% Deposit Amount (£) *</label>
                    <input type="number" step="0.01" id="depositAmount" name="deposit_amount" class="adm-form-control" required value="{{ old('deposit_amount', '36.00') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Deposit Status *</label>
                    <select name="deposit_status" class="adm-form-control" required>
                        <option value="paid">Paid (Confirmed)</option>
                        <option value="pending" selected>Pending (Awaiting Deposit)</option>
                        <option value="waived">Waived</option>
                    </select>
                </div>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Overall Booking Status *</label>
                    <select name="status" class="adm-form-control" required>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending" selected>Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">70% Balance Status *</label>
                    <select name="balance_status" class="adm-form-control" required>
                        <option value="pending" selected>Pending (Due on service)</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Admin Notes</label>
                <textarea name="admin_notes" class="adm-form-control" placeholder="Internal booking notes...">{{ old('admin_notes') }}</textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 28px;">Save & Create Booking</button>
                <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const serviceSelect = document.getElementById('serviceSelect');
    const serviceName = document.getElementById('serviceName');
    const totalPrice = document.getElementById('totalPrice');
    const depositAmount = document.getElementById('depositAmount');

    serviceSelect?.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (opt.value) {
            serviceName.value = opt.getAttribute('data-name');
            const p = parseFloat(opt.getAttribute('data-price') || 0);
            totalPrice.value = p.toFixed(2);
            depositAmount.value = (p * 0.30).toFixed(2);
        }
    });

    totalPrice?.addEventListener('input', function() {
        const p = parseFloat(this.value || 0);
        depositAmount.value = (p * 0.30).toFixed(2);
    });
</script>
@endsection