@extends('admin.layout')

@section('title', 'Manage Bookings')
@section('header_title', 'Client Appointments & Bookings')

@section('content')
<!-- Stats Bar -->
<div class="adm-stats-grid" style="margin-bottom: 24px;">
    <div class="adm-stat-card">
        <div class="adm-stat-info">
            <h3>Total Bookings</h3>
            <div class="stat-number">{{ $stats['total'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-warning">
        <div class="adm-stat-info">
            <h3>Pending Confirmation</h3>
            <div class="stat-number">{{ $stats['pending'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-accent">
        <div class="adm-stat-info">
            <h3>Confirmed Appointments</h3>
            <div class="stat-number">{{ $stats['confirmed'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-success">
        <div class="adm-stat-info">
            <h3>Completed Sessions</h3>
            <div class="stat-number">{{ $stats['completed'] }}</div>
        </div>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="adm-card" style="margin-bottom: 20px;">
    <div class="adm-card-body" style="padding: 18px 24px;">
        <form method="GET" action="{{ route('admin.bookings.index') }}" style="display: flex; gap: 14px; flex-wrap: wrap; align-items: flex-end;">
            <div style="flex: 1; min-width: 200px;">
                <label class="adm-form-label">Search Client / Ref / Style</label>
                <input type="text" name="search" class="adm-form-control" placeholder="Search by name, email, phone or ref..." value="{{ request('search') }}">
            </div>
            <div style="width: 160px;">
                <label class="adm-form-label">Status</label>
                <select name="status" class="adm-form-control">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div style="width: 160px;">
                <label class="adm-form-label">Deposit Status</label>
                <select name="deposit_status" class="adm-form-control">
                    <option value="">All Deposits</option>
                    <option value="pending" {{ request('deposit_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('deposit_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="refunded" {{ request('deposit_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
            <div style="width: 170px;">
                <label class="adm-form-label">Date</label>
                <input type="date" name="date" class="adm-form-control" value="{{ request('date') }}">
            </div>
            <div>
                <button type="submit" class="adm-btn adm-btn-primary">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline">Reset</a>
            </div>
            <div style="margin-left: auto;">
                <a href="{{ route('admin.bookings.create') }}" class="adm-btn adm-btn-accent">+ New Booking</a>
            </div>
        </form>
    </div>
</div>

<!-- Bookings List Table -->
<div class="adm-card">
    <div class="adm-card-header">
        <div class="adm-card-title">Bookings Log ({{ $bookings->total() }})</div>
    </div>
    <div class="adm-card-body" style="padding: 0;">
        @if($bookings->count() > 0)
            <div class="adm-table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Client Info</th>
                            <th>Hairstyle</th>
                            <th>Date & Time</th>
                            <th>Location</th>
                            <th>Total / 30% Deposit</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $bk)
                            <tr>
                                <td>
                                    <strong style="font-family: monospace; color: var(--adm-primary);">{{ $bk->booking_reference }}</strong>
                                    <div style="font-size: 0.72rem; color: var(--adm-text-muted);">{{ $bk->created_at->format('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    <strong>{{ $bk->client_name }}</strong>
                                    <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ $bk->client_phone }}</div>
                                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $bk->client_email }}</div>
                                </td>
                                <td>
                                    <strong>{{ $bk->service_name }}</strong>
                                    <div style="font-size: 0.75rem; color: var(--adm-accent-dark);">
                                        Gel: {{ ucfirst(str_replace('_', ' ', $bk->gel_preference)) }}
                                        @if($bk->hair_length_option) • {{ $bk->hair_length_option }} @endif
                                    </div>
                                </td>
                                <td>
                                    <div><strong>{{ \Carbon\Carbon::parse($bk->appointment_date)->format('D, d M Y') }}</strong></div>
                                    <div style="font-size: 0.78rem; color: var(--adm-accent-dark); font-weight: 600;">{{ $bk->appointment_time }}</div>
                                </td>
                                <td>
                                    <span style="font-size: 0.8rem; text-transform: capitalize;">{{ str_replace('_', ' ', $bk->service_location_type) }}</span>
                                    @if($bk->city)
                                        <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $bk->city }} @if($bk->postcode) ({{ $bk->postcode }}) @endif</div>
                                    @endif
                                </td>
                                <td>
                                    <div><strong>£{{ number_format($bk->total_price, 2) }}</strong></div>
                                    <div style="font-size: 0.78rem;">
                                        Dep: £{{ number_format($bk->deposit_amount, 2) }}
                                        <span class="status-pill status-{{ $bk->deposit_status === 'paid' ? 'paid' : 'unpaid' }}" style="padding: 1px 6px; font-size: 0.68rem;">{{ $bk->deposit_status }}</span>
                                    </div>
                                    @if($bk->payment_proof)
                                        <div style="margin-top: 4px;">
                                            <a href="{{ url($bk->payment_proof) }}" target="_blank" class="status-pill status-paid" style="padding: 2px 7px; font-size: 0.68rem; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                                📸 View Proof
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-pill status-{{ $bk->status }}">{{ $bk->status }}</span>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="{{ route('admin.bookings.show', $bk) }}" class="adm-btn adm-btn-outline adm-btn-sm">Details</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($bookings->hasPages())
            <div class="adm-pagination-container">
                {{ $bookings->links() }}
            </div>
            @endif
        @else
            <div style="padding: 40px; text-align: center; color: var(--adm-text-muted);">
                <p>No bookings matching the selected criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection
