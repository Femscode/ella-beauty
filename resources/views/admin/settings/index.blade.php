@extends('admin.layout')

@section('title', 'Site Settings')
@section('header_title', 'Configuration & Business Policies')

@section('content')
<div class="adm-card" style="max-width: 850px; margin: 0 auto;">
    <div class="adm-card-header">
        <div class="adm-card-title">Ella Beauty Business & Booking Parameters</div>
    </div>
    <div class="adm-card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin-bottom: 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">1. General Business Information</h3>
            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Brand / Studio Name</label>
                    <input type="text" name="site_name" class="adm-form-control" value="{{ \App\Models\Setting::get('site_name', 'Ella Beauty') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Primary Service Base</label>
                    <input type="text" name="primary_location" class="adm-form-control" value="{{ \App\Models\Setting::get('primary_location', 'Luton & Surrounding Areas, UK') }}">
                </div>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Contact Phone / WhatsApp</label>
                    <input type="text" name="contact_phone" class="adm-form-control" value="{{ \App\Models\Setting::get('contact_phone', '+44 7424 928399') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Contact Email Address</label>
                    <input type="email" name="contact_email" class="adm-form-control" value="{{ \App\Models\Setting::get('contact_email', 'contact@ellabeauty.co.uk') }}">
                </div>
            </div>

            <h3 style="font-size: 1rem; color: var(--adm-primary); margin: 24px 0 16px; border-bottom: 1px solid var(--adm-border); padding-bottom: 8px;">2. Booking Deposit & Policy Settings</h3>
            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Default Deposit (%)</label>
                    <input type="number" step="0.01" name="deposit_percentage" class="adm-form-control" value="{{ \App\Models\Setting::get('deposit_percentage', '30') }}">
                    <small style="color: var(--adm-text-muted); font-size: 0.75rem;">Standard 30% booking deposit</small>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Emergency Slot Surcharge (£)</label>
                    <input type="number" step="0.01" name="emergency_fee" class="adm-form-control" value="{{ \App\Models\Setting::get('emergency_fee', '30.00') }}">
                    <small style="color: var(--adm-text-muted); font-size: 0.75rem;">Same-day / short-notice booking fee</small>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Late Arrival Fee (15+ mins) (£)</label>
                    <input type="number" step="0.01" name="late_fee_15min" class="adm-form-control" value="{{ \App\Models\Setting::get('late_fee_15min', '10.00') }}">
                    <small style="color: var(--adm-text-muted); font-size: 0.75rem;">Late arrival fee</small>
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Deposit Payment Instructions / Bank Details Note</label>
                <textarea name="deposit_payment_instructions" class="adm-form-control" placeholder="Bank transfer instructions, account name, sort code, account number or Monzo / Revolut payment details shown to clients after booking...">{{ \App\Models\Setting::get('deposit_payment_instructions', 'Please transfer the 30% deposit to secure your appointment slot. Send your payment screenshot to WhatsApp +44 7424 928399 with your booking reference.') }}</textarea>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 28px;">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
