@extends('admin.layout')

@section('title', 'Edit ' . $service->name)
@section('header_title', 'Edit Hairstyle: ' . $service->name)

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">← Back to Services Menu</a>
</div>

<div class="adm-card" style="max-width: 800px; margin: 0 auto;">
    <div class="adm-card-header">
        <div class="adm-card-title">Modify Service Details & Rate</div>
    </div>
    <div class="adm-card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="adm-form-group">
                <label class="adm-form-label">Hairstyle Name *</label>
                <input type="text" name="name" class="adm-form-control" required value="{{ old('name', $service->name) }}">
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Category *</label>
                    <select name="service_category_id" class="adm-form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('service_category_id', $service->service_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Estimated Duration *</label>
                    <input type="text" name="duration_hours" class="adm-form-control" required value="{{ old('duration_hours', $service->duration_hours) }}">
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Price (£) *</label>
                    <input type="number" step="0.01" id="priceInput" name="price" class="adm-form-control" required value="{{ old('price', $service->price) }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Deposit %</label>
                    <input type="number" step="0.01" id="depositPctInput" name="deposit_percentage" class="adm-form-control" value="{{ old('deposit_percentage', $service->deposit_percentage ?? '30.00') }}">
                </div>
                <div class="adm-form-group">
                    <label class="adm-form-label">Deposit Amount (£)</label>
                    <input type="text" id="depositAmtDisplay" class="adm-form-control" readonly style="background: #F1F5F9;" value="£{{ number_format($service->deposit_amount, 2) }}">
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Hair Extensions & Inclusion Note</label>
                <textarea name="hair_extensions_note" class="adm-form-control">{{ old('hair_extensions_note', $service->hair_extensions_note) }}</textarea>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Description (Optional)</label>
                <textarea name="description" class="adm-form-control">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="adm-grid-3" style="margin-top: 16px;">
                <div class="adm-form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="hair_included" value="1" {{ old('hair_included', $service->hair_included) ? 'checked' : '' }}>
                        <span style="font-size: 0.9rem; font-weight: 600;">Hair Included in Fee</span>
                    </label>
                </div>
                <div class="adm-form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                        <span style="font-size: 0.9rem; font-weight: 600;">Feature on Landing</span>
                    </label>
                </div>
                <div class="adm-form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                        <span style="font-size: 0.9rem; font-weight: 600;">Active in Booking</span>
                    </label>
                </div>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="adm-btn adm-btn-primary">Update Hairstyle Service</button>
                <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const priceInput = document.getElementById('priceInput');
    const depositPctInput = document.getElementById('depositPctInput');
    const depositAmtDisplay = document.getElementById('depositAmtDisplay');

    function calcDeposit() {
        const p = parseFloat(priceInput.value || 0);
        const pct = parseFloat(depositPctInput.value || 30);
        depositAmtDisplay.value = '£' + ((p * pct) / 100).toFixed(2);
    }

    priceInput?.addEventListener('input', calcDeposit);
    depositPctInput?.addEventListener('input', calcDeposit);
</script>
@endsection
