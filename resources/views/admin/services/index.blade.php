@extends('admin.layout')

@section('title', 'Hairstyle Pricing Menu')
@section('header_title', 'Hairstyle Pricing Menu & Catalog (25 Services)')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; gap: 16px; flex-wrap: wrap;">
    <form method="GET" action="{{ route('admin.services.index') }}" style="display: flex; gap: 12px; flex: 1; max-width: 600px;">
        <input type="text" name="search" class="adm-form-control" placeholder="Search hairstyle by name..." value="{{ request('search') }}">
        <select name="category_id" class="adm-form-control" style="max-width: 220px;" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="adm-btn adm-btn-primary">Search</button>
    </form>
    <a href="{{ route('admin.services.create') }}" class="adm-btn adm-btn-accent">+ Add New Hairstyle</a>
</div>

<div class="adm-card">
    <div class="adm-card-header">
        <div class="adm-card-title">Hairstyle Catalog & Rate Card</div>
    </div>
    <div class="adm-card-body" style="padding: 0;">
        <div class="adm-table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hairstyle Title</th>
                        <th>Category</th>
                        <th>Estimated Duration</th>
                        <th>Price</th>
                        <th>30% Deposit</th>
                        <th>Extensions Policy</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $srv)
                    <tr>
                        <td>{{ $srv->sort_order }}</td>
                        <td>
                            <strong>{{ $srv->name }}</strong>
                            @if($srv->is_featured)
                            <span class="adm-badge" style="font-size: 0.68rem; margin-left: 6px;">Featured</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-pill status-confirmed">{{ $srv->category->name ?? 'Unassigned' }}</span>
                        </td>
                        <td>
                            <span style="font-size: 0.85rem; color: var(--adm-text-muted);">⏱ {{ $srv->duration_hours }}</span>
                        </td>
                        <td>
                            <strong style="font-size: 1rem; color: var(--adm-primary-dark);">£{{ number_format($srv->price, 2) }}</strong>
                        </td>
                        <td>
                            <span style="color: var(--adm-accent-dark); font-weight: 600;">£{{ number_format($srv->deposit_amount, 2) }}</span>
                        </td>
                        <td>
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted); max-width: 250px; line-height: 1.3;">
                                {{ Str::limit($srv->hair_extensions_note, 65) }}
                            </div>
                        </td>
                        <td>
                            @if($srv->is_active)
                            <span class="status-pill status-completed">Active</span>
                            @else
                            <span class="status-pill status-cancelled">Disabled</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 6px;">
                                <a href="{{ route('admin.services.edit', $srv) }}" class="adm-btn adm-btn-outline adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.services.destroy', $srv) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 40px; color: var(--adm-text-muted);">
                            No services found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
        <div class="adm-pagination-container">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>
@endsection