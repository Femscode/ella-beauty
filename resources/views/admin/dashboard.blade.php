@extends('admin.layout')

@section('title', 'Admin Overview')
@section('header_title', 'Studio & Mobile Overview')

@section('content')
<!-- Stats Cards Row -->
<div class="adm-stats-grid">
    <div class="adm-stat-card stat-accent">
        <div class="adm-stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div class="adm-stat-info">
            <h3>Total Bookings</h3>
            <div class="stat-number">{{ $totalBookings }}</div>
            <div class="stat-sub">{{ $confirmedBookings }} confirmed / {{ $pendingBookings }} pending</div>
        </div>
    </div>

    <div class="adm-stat-card stat-warning">
        <div class="adm-stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
        <div class="adm-stat-info">
            <h3>Pending Actions</h3>
            <div class="stat-number">{{ $pendingBookings }}</div>
            <div class="stat-sub">£{{ number_format($pendingDeposits, 2) }} pending deposits</div>
        </div>
    </div>

    <div class="adm-stat-card stat-success">
        <div class="adm-stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        </div>
        <div class="adm-stat-info">
            <h3>Estimated Revenue</h3>
            <div class="stat-number">£{{ number_format($totalRevenue, 2) }}</div>
            <div class="stat-sub">£{{ number_format($depositsCollected, 2) }} deposits secured</div>
        </div>
    </div>

    <div class="adm-stat-card">
        <div class="adm-stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
        </div>
        <div class="adm-stat-info">
            <h3>Active Hairstyles</h3>
            <div class="stat-number">{{ $totalServices }}</div>
            <div class="stat-sub">Across 9 styling categories</div>
        </div>
    </div>
</div>

<!-- Two-Column Grid: Upcoming Appointments & Recent Bookings -->
<div class="adm-grid-2">
    <!-- Upcoming Appointments Schedule -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span>Upcoming Appointments</span>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">View Calendar</a>
        </div>
        <div class="adm-card-body" style="padding: 0;">
            @if($upcomingAppointments->count() > 0)
                <div class="adm-table-responsive">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>Client & Hairstyle</th>
                                <th>Date & Time</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingAppointments as $app)
                                <tr>
                                    <td>
                                        <strong>{{ $app->client_name }}</strong>
                                        <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ $app->service_name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($app->appointment_date)->format('D, d M Y') }}</div>
                                        <div style="font-size: 0.78rem; color: var(--adm-accent-dark); font-weight: 600;">{{ $app->appointment_time }}</div>
                                    </td>
                                    <td>
                                        <span style="font-size: 0.8rem; text-transform: capitalize;">{{ str_replace('_', ' ', $app->service_location_type) }}</span>
                                        @if($app->city)
                                            <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $app->city }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-pill status-{{ $app->status }}">{{ $app->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="padding: 32px; text-align: center; color: var(--adm-text-muted);">
                    <p>No upcoming appointments scheduled yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Inquiries & System Shortcuts -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                <span>Quick Operations</span>
            </div>
        </div>
        <div class="adm-card-body" style="display: flex; flex-direction: column; gap: 14px;">
            <a href="{{ route('admin.bookings.create') }}" class="adm-btn adm-btn-primary" style="justify-content: flex-start; padding: 14px 18px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Record New Manual Booking / Client Appointment</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-accent" style="justify-content: flex-start; padding: 14px 18px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path></svg>
                <span>Manage Hairstyle Pricing Menu (25 Services)</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="adm-btn adm-btn-outline" style="justify-content: flex-start; padding: 14px 18px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <span>Upload New Portfolio / Lookbook Styles</span>
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="adm-btn adm-btn-outline" style="justify-content: flex-start; padding: 14px 18px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                <span>Manage Client Testimonials & Feedback</span>
            </a>
        </div>
    </div>
</div>

<!-- Recent Booking Requests -->
<div class="adm-card">
    <div class="adm-card-header">
        <div class="adm-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <span>Latest Client Booking Submissions</span>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">View All Bookings</a>
    </div>
    <div class="adm-card-body" style="padding: 0;">
        @if($recentBookings->count() > 0)
            <div class="adm-table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Client Details</th>
                            <th>Hairstyle & Specs</th>
                            <th>Date & Time</th>
                            <th>Fee & 30% Deposit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $bk)
                            <tr>
                                <td>
                                    <strong style="font-family: monospace; color: var(--adm-primary);">{{ $bk->booking_reference }}</strong>
                                    <div style="font-size: 0.72rem; color: var(--adm-text-muted);">{{ $bk->created_at->diffForHumans() }}</div>
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
                                    <div>{{ \Carbon\Carbon::parse($bk->appointment_date)->format('d M Y') }}</div>
                                    <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ $bk->appointment_time }}</div>
                                </td>
                                <td>
                                    <div><strong>£{{ number_format($bk->total_price, 2) }}</strong></div>
                                    <div style="font-size: 0.78rem; color: {{ $bk->deposit_status === 'paid' ? 'var(--adm-success)' : '#B45309' }};">
                                        Deposit: £{{ number_format($bk->deposit_amount, 2) }} ({{ $bk->deposit_status }})
                                    </div>
                                </td>
                                <td>
                                    <span class="status-pill status-{{ $bk->status }}">{{ $bk->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $bk) }}" class="adm-btn adm-btn-outline adm-btn-sm">Review</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 40px; text-align: center; color: var(--adm-text-muted);">
                <p>No bookings received yet. Client appointments booked on the website will appear here in real time.</p>
            </div>
        @endif
    </div>
</div>
@endsection
