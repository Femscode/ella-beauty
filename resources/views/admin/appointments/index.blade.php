@extends('admin.layout')

@section('title', 'Appointment Calendar & Availability')
@section('header_title', 'Appointment Calendar & Availability')

@section('content')
<!-- Stats Bar -->
<div class="adm-stats-grid" style="margin-bottom: 24px;">
    <div class="adm-stat-card">
        <div class="adm-stat-info">
            <h3>Appointments in {{ $currentMonthDate->format('M Y') }}</h3>
            <div class="stat-number">{{ $stats['total_this_month'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-accent">
        <div class="adm-stat-info">
            <h3>Confirmed Sessions</h3>
            <div class="stat-number">{{ $stats['confirmed_this_month'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-warning">
        <div class="adm-stat-info">
            <h3>Pending Approval</h3>
            <div class="stat-number">{{ $stats['pending_this_month'] }}</div>
        </div>
    </div>
    <div class="adm-stat-card stat-danger">
        <div class="adm-stat-info">
            <h3>Blocked / Off Days</h3>
            <div class="stat-number">{{ $stats['unavailable_days_this_month'] }}</div>
        </div>
    </div>
</div>

<!-- Main Calendar & Availability Layout Grid -->
<div class="cal-main-layout">
    
    <!-- LEFT: Calendar Overview Card -->
    <div class="cal-main-col">
        <div class="adm-card">
            <!-- Calendar Navigation Header -->
            <div class="cal-header-bar">
                <div class="cal-month-nav">
                    <a href="{{ route('admin.appointments.index', ['year' => $prevMonthDate->year, 'month' => $prevMonthDate->month]) }}" class="cal-nav-btn" title="Previous Month">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </a>
                    <h2 class="cal-current-title">{{ $currentMonthDate->format('F Y') }}</h2>
                    <a href="{{ route('admin.appointments.index', ['year' => $nextMonthDate->year, 'month' => $nextMonthDate->month]) }}" class="cal-nav-btn" title="Next Month">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                    <a href="{{ route('admin.appointments.index', ['year' => now()->year, 'month' => now()->month]) }}" class="cal-today-btn">
                        Today
                    </a>
                </div>

                <div class="cal-actions">
                    <button type="button" class="adm-btn adm-btn-danger" onclick="openBlockModal('{{ now()->format('Y-m-d') }}')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                        <span>Set Unavailable Day</span>
                    </button>
                    <a href="{{ route('admin.bookings.create') }}" class="adm-btn adm-btn-accent">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <span>New Booking</span>
                    </a>
                </div>
            </div>

            <!-- Calendar Grid Container -->
            <div class="cal-grid-wrapper">
                <!-- Day of Week Headers (Mon - Sun) -->
                <div class="cal-weekdays-row">
                    <div class="cal-weekday">Mon</div>
                    <div class="cal-weekday">Tue</div>
                    <div class="cal-weekday">Wed</div>
                    <div class="cal-weekday">Thu</div>
                    <div class="cal-weekday">Fri</div>
                    <div class="cal-weekday weekend">Sat</div>
                    <div class="cal-weekday weekend">Sun</div>
                </div>

                <!-- Calendar Days Grid -->
                <div class="cal-month-grid">
                    {{-- Leading padding days from previous month --}}
                    @for($i = 0; $i < $paddingDays; $i++)
                        <div class="cal-day-cell is-padding"></div>
                    @endfor

                    {{-- Month Days --}}
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $loopDate = \Carbon\Carbon::createFromDate($year, $month, $day);
                            $dateStr = $loopDate->format('Y-m-d');
                            $isToday = $loopDate->isToday();
                            $isPast = $loopDate->isPast() && !$isToday;
                            $isBlocked = isset($unavailableDates[$dateStr]);
                            $blockedInfo = $isBlocked ? $unavailableDates[$dateStr] : null;
                            $dayBookings = $bookingsByDate[$dateStr] ?? [];
                            $isWeekend = $loopDate->isWeekend();
                        @endphp

                        <div class="cal-day-cell {{ $isToday ? 'is-today' : '' }} {{ $isBlocked ? 'is-blocked' : '' }} {{ $isPast ? 'is-past' : '' }} {{ $isWeekend ? 'is-weekend' : '' }}">
                            <div class="cal-cell-header">
                                <span class="cal-day-number {{ $isToday ? 'today-pill' : '' }}">{{ $day }}</span>
                                
                                <div class="cal-cell-quick-actions">
                                    @if($isBlocked)
                                        <form action="{{ route('admin.appointments.unavailable.destroy', $blockedInfo->id) }}" method="POST" onsubmit="return confirm('Unblock {{ $dateStr }} and open it for bookings?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cal-action-icon-btn text-danger" title="Unblock this day">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="cal-action-icon-btn" onclick="openBlockModal('{{ $dateStr }}')" title="Mark day unavailable">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Blocked Banner --}}
                            @if($isBlocked)
                                <div class="cal-blocked-tag" title="{{ $blockedInfo->notes ?? $blockedInfo->reason }}">
                                    <span class="blocked-icon">⛔</span>
                                    <span class="blocked-label">{{ $blockedInfo->reason ?? 'Day Off' }}</span>
                                </div>
                            @endif

                            {{-- Bookings list for this day --}}
                            <div class="cal-events-list">
                                @foreach($dayBookings as $b)
                                    @php
                                        $statusClass = match($b->status) {
                                            'confirmed' => 'evt-confirmed',
                                            'completed' => 'evt-completed',
                                            'cancelled' => 'evt-cancelled',
                                            default => 'evt-pending',
                                        };
                                        $isOvernight = str_contains(strtolower($b->appointment_time), 'overnight') || str_contains(strtolower($b->appointment_time), '06:00');
                                    @endphp
                                    <div class="cal-event-chip {{ $statusClass }} {{ $isOvernight ? 'evt-overnight' : '' }}" 
                                         onclick="showBookingModal({{ json_encode([
                                             'ref' => $b->booking_reference,
                                             'client_name' => $b->client_name,
                                             'client_email' => $b->client_email,
                                             'client_phone' => $b->client_phone,
                                             'service_name' => $b->service_name,
                                             'date' => $loopDate->format('D, d M Y'),
                                             'time' => $b->appointment_time,
                                             'location' => ucfirst(str_replace('_', ' ', $b->service_location_type)),
                                             'address' => $b->address ?? 'Home Salon (Luton)',
                                             'city' => $b->city ?? 'Luton',
                                             'total' => number_format($b->total_price, 2),
                                             'deposit' => number_format($b->deposit_amount, 2),
                                             'deposit_status' => ucfirst($b->deposit_status),
                                             'status' => ucfirst($b->status),
                                             'proof_url' => $b->payment_proof_url,
                                             'notes' => $b->client_notes,
                                             'url' => route('admin.bookings.show', $b->id),
                                         ]) }})">
                                        <div class="event-chip-time">
                                            @if($isOvernight)
                                                🌙 {{ $b->appointment_time }}
                                            @else
                                                ⏰ {{ $b->appointment_time }}
                                            @endif
                                        </div>
                                        <div class="event-chip-title">{{ $b->client_name }}</div>
                                        <div class="event-chip-sub">{{ \Illuminate\Support\Str::limit($b->service_name, 22) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Legend Bar -->
            <div class="cal-legend-bar">
                <div class="cal-legend-item">
                    <span class="legend-dot dot-confirmed"></span>
                    <span>Confirmed</span>
                </div>
                <div class="cal-legend-item">
                    <span class="legend-dot dot-pending"></span>
                    <span>Pending Deposit / Approval</span>
                </div>
                <div class="cal-legend-item">
                    <span class="legend-dot dot-overnight"></span>
                    <span>Overnight Slot (6 PM)</span>
                </div>
                <div class="cal-legend-item">
                    <span class="legend-dot dot-blocked"></span>
                    <span>Admin Blocked / Day Off</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Blackout Dates Management Sidebar -->
    <div class="cal-side-col">
        <!-- Add Unavailable Date Card -->
        <div class="adm-card" style="margin-bottom: 24px;">
            <div class="adm-card-header">
                <div class="adm-card-title">Set Unavailable Dates</div>
            </div>
            <div class="adm-card-body">
                <p style="font-size: 0.85rem; color: var(--adm-text-muted); margin-bottom: 16px;">
                    Block dates when you are on leave, holiday, or unavailable for appointments. Clients will not be able to book these dates.
                </p>

                <form action="{{ route('admin.appointments.unavailable.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 14px;">
                        <label class="adm-form-label">Start Date *</label>
                        <input type="date" id="blockStartDate" name="date" class="adm-form-control" min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="adm-form-label">End Date (Optional for date range)</label>
                        <input type="date" id="blockEndDate" name="end_date" class="adm-form-control" min="{{ now()->format('Y-m-d') }}">
                        <span style="font-size: 0.75rem; color: var(--adm-text-muted);">Leave empty to block only a single day.</span>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="adm-form-label">Reason / Label</label>
                        <select name="reason" class="adm-form-control">
                            <option value="Unavailable / Day Off">Unavailable / Day Off</option>
                            <option value="Fully Booked">Fully Booked</option>
                            <option value="Personal Holiday / Travel">Personal Holiday / Travel</option>
                            <option value="Salon Maintenance">Salon Maintenance</option>
                            <option value="Emergency Leave">Emergency Leave</option>
                            <option value="Special Event">Special Event</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="adm-form-label">Private Notes (Optional)</label>
                        <textarea name="notes" class="adm-form-control" rows="2" placeholder="Admin reference note..."></textarea>
                    </div>

                    <button type="submit" class="adm-btn adm-btn-danger" style="width: 100%;">
                        Save Blocked Date(s)
                    </button>
                </form>
            </div>
        </div>

        <!-- Upcoming Blocked Dates List -->
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Upcoming Blocked Dates ({{ $upcomingUnavailable->count() }})</div>
            </div>
            <div class="adm-card-body" style="padding: 0;">
                @if($upcomingUnavailable->count() > 0)
                    <div class="cal-blocked-list">
                        @foreach($upcomingUnavailable as $un)
                            <div class="cal-blocked-item">
                                <div class="blocked-item-info">
                                    <div class="blocked-item-date">{{ $un->date->format('D, d M Y') }}</div>
                                    <div class="blocked-item-reason">{{ $un->reason ?? 'Unavailable' }}</div>
                                    @if($un->notes)
                                        <div class="blocked-item-notes">{{ $un->notes }}</div>
                                    @endif
                                </div>
                                <form action="{{ route('admin.appointments.unavailable.destroy', $un->id) }}" method="POST" onsubmit="return confirm('Remove blocked date {{ $un->date->format('Y-m-d') }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove-blocked" title="Unblock this date">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="padding: 24px 20px; text-align: center; color: var(--adm-text-muted); font-size: 0.88rem;">
                        No upcoming dates are currently blocked. You are open for all regular business days.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     QUICK BOOKING DETAIL MODAL
     ========================================================================= -->
<div class="cal-modal-backdrop" id="bookingDetailModal" onclick="closeBookingModal(event)">
    <div class="cal-modal-box">
        <div class="cal-modal-header">
            <div>
                <span class="modal-pill-tag" id="modalBookingRef">EB-2026-XXXX</span>
                <h3 class="cal-modal-title" id="modalClientName">Client Name</h3>
            </div>
            <button type="button" class="cal-modal-close" onclick="closeBookingModal()">&times;</button>
        </div>
        <div class="cal-modal-body">
            <div class="modal-detail-row">
                <div class="detail-label">Hairstyle / Service:</div>
                <div class="detail-value" id="modalServiceName" style="font-weight: 700; color: var(--adm-primary);"></div>
            </div>
            <div class="modal-detail-grid">
                <div class="modal-detail-row">
                    <div class="detail-label">Appointment Date:</div>
                    <div class="detail-value" id="modalDate"></div>
                </div>
                <div class="modal-detail-row">
                    <div class="detail-label">Time Slot:</div>
                    <div class="detail-value" id="modalTime" style="font-weight: 700;"></div>
                </div>
            </div>
            <div class="modal-detail-grid">
                <div class="modal-detail-row">
                    <div class="detail-label">Client Phone:</div>
                    <div class="detail-value" id="modalPhone"></div>
                </div>
                <div class="modal-detail-row">
                    <div class="detail-label">Client Email:</div>
                    <div class="detail-value" id="modalEmail"></div>
                </div>
            </div>
            <div class="modal-detail-grid">
                <div class="modal-detail-row">
                    <div class="detail-label">Service Location:</div>
                    <div class="detail-value" id="modalLocation"></div>
                </div>
                <div class="modal-detail-row">
                    <div class="detail-label">City:</div>
                    <div class="detail-value" id="modalCity"></div>
                </div>
            </div>
            <div class="modal-detail-grid">
                <div class="modal-detail-row">
                    <div class="detail-label">Total Price:</div>
                    <div class="detail-value" id="modalTotal" style="font-weight: 800; color: var(--adm-primary);"></div>
                </div>
                <div class="modal-detail-row">
                    <div class="detail-label">30% Deposit:</div>
                    <div class="detail-value" id="modalDeposit" style="font-weight: 700; color: var(--adm-accent-dark);"></div>
                </div>
            </div>
            <div class="modal-detail-row">
                <div class="detail-label">Booking Status:</div>
                <div class="detail-value" id="modalStatus"></div>
            </div>
            <div class="modal-detail-row" id="modalNotesRow" style="display:none;">
                <div class="detail-label">Client Notes:</div>
                <div class="detail-value" id="modalNotes" style="font-style: italic; color: var(--adm-text-muted);"></div>
            </div>
            <div class="modal-detail-row" id="modalProofRow" style="display:none; margin-top: 10px;">
                <div class="detail-label">Payment Proof Attached:</div>
                <div class="detail-value">
                    <a href="#" id="modalProofLink" target="_blank" class="adm-btn adm-btn-outline adm-btn-sm">
                        🔍 View Uploaded Screenshot
                    </a>
                </div>
            </div>
        </div>
        <div class="cal-modal-footer">
            <button type="button" class="adm-btn adm-btn-outline" onclick="closeBookingModal()">Close</button>
            <a href="#" id="modalFullViewBtn" class="adm-btn adm-btn-primary">View Full Booking Record &rarr;</a>
        </div>
    </div>
</div>

<!-- =========================================================================
     BLOCK DATE MODAL
     ========================================================================= -->
<div class="cal-modal-backdrop" id="blockDateModal" onclick="closeBlockModal(event)">
    <div class="cal-modal-box">
        <div class="cal-modal-header">
            <div>
                <span class="modal-pill-tag tag-danger">Admin Availability</span>
                <h3 class="cal-modal-title">Block Date as Unavailable</h3>
            </div>
            <button type="button" class="cal-modal-close" onclick="closeBlockModal()">&times;</button>
        </div>
        <form action="{{ route('admin.appointments.unavailable.store') }}" method="POST">
            @csrf
            <div class="cal-modal-body">
                <div style="margin-bottom: 14px;">
                    <label class="adm-form-label">Selected Date *</label>
                    <input type="date" id="modalBlockDate" name="date" class="adm-form-control" required>
                </div>

                <div style="margin-bottom: 14px;">
                    <label class="adm-form-label">End Date (Leave blank for single day)</label>
                    <input type="date" id="modalBlockEndDate" name="end_date" class="adm-form-control">
                </div>

                <div style="margin-bottom: 14px;">
                    <label class="adm-form-label">Reason</label>
                    <select name="reason" class="adm-form-control">
                        <option value="Unavailable / Day Off">Unavailable / Day Off</option>
                        <option value="Fully Booked">Fully Booked</option>
                        <option value="Personal Holiday / Travel">Personal Holiday / Travel</option>
                        <option value="Salon Maintenance">Salon Maintenance</option>
                        <option value="Emergency Leave">Emergency Leave</option>
                    </select>
                </div>

                <div style="margin-bottom: 10px;">
                    <label class="adm-form-label">Notes</label>
                    <textarea name="notes" class="adm-form-control" rows="2" placeholder="Optional notes for your records..."></textarea>
                </div>
            </div>
            <div class="cal-modal-footer">
                <button type="button" class="adm-btn adm-btn-outline" onclick="closeBlockModal()">Cancel</button>
                <button type="submit" class="adm-btn adm-btn-danger">Block This Date</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showBookingModal(data) {
        document.getElementById('modalBookingRef').textContent = data.ref;
        document.getElementById('modalClientName').textContent = data.client_name;
        document.getElementById('modalServiceName').textContent = data.service_name;
        document.getElementById('modalDate').textContent = data.date;
        document.getElementById('modalTime').textContent = data.time;
        document.getElementById('modalPhone').textContent = data.client_phone;
        document.getElementById('modalEmail').textContent = data.client_email;
        document.getElementById('modalLocation').textContent = data.location;
        document.getElementById('modalCity').textContent = data.city;
        document.getElementById('modalTotal').textContent = '£' + data.total;
        document.getElementById('modalDeposit').textContent = '£' + data.deposit + ' (' + data.deposit_status + ')';
        document.getElementById('modalStatus').innerHTML = '<span class="adm-badge adm-badge-primary">' + data.status + '</span>';
        document.getElementById('modalFullViewBtn').href = data.url;

        const notesRow = document.getElementById('modalNotesRow');
        if (data.notes && data.notes.trim() !== '') {
            document.getElementById('modalNotes').textContent = data.notes;
            notesRow.style.display = 'flex';
        } else {
            notesRow.style.display = 'none';
        }

        const proofRow = document.getElementById('modalProofRow');
        if (data.proof_url) {
            document.getElementById('modalProofLink').href = data.proof_url;
            proofRow.style.display = 'flex';
        } else {
            proofRow.style.display = 'none';
        }

        const modal = document.getElementById('bookingDetailModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBookingModal(event) {
        if (event && event.target && event.target.id !== 'bookingDetailModal' && !event.target.classList.contains('cal-modal-close')) {
            return;
        }
        document.getElementById('bookingDetailModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    function openBlockModal(dateStr) {
        document.getElementById('modalBlockDate').value = dateStr;
        document.getElementById('modalBlockEndDate').min = dateStr;
        const modal = document.getElementById('blockDateModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBlockModal(event) {
        if (event && event.target && event.target.id !== 'blockDateModal' && !event.target.classList.contains('cal-modal-close')) {
            return;
        }
        document.getElementById('blockDateModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeBookingModal();
            closeBlockModal();
        }
    });
</script>
@endsection
