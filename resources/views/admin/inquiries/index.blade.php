@extends('admin.layout')

@section('title', 'Client Inquiries')
@section('header_title', 'Client Messages & Inquiries')

@section('content')
<div class="adm-card">
    <div class="adm-card-header">
        <div class="adm-card-title">Contact Messages ({{ $inquiries->total() }})</div>
    </div>
    <div class="adm-card-body" style="padding: 0;">
        <div class="adm-table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Sender Details</th>
                        <th>Subject & Message</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inq)
                        <tr>
                            <td>
                                <div>{{ $inq->created_at->format('d M Y') }}</div>
                                <div style="font-size: 0.72rem; color: var(--adm-text-muted);">{{ $inq->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <strong>{{ $inq->name }}</strong>
                                <div style="font-size: 0.75rem;"><a href="mailto:{{ $inq->email }}" style="color: var(--adm-accent-dark);">{{ $inq->email }}</a></div>
                                @if($inq->phone)
                                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $inq->phone }}</div>
                                @endif
                            </td>
                            <td>
                                @if($inq->subject)
                                    <div style="font-weight: 600; color: var(--adm-primary-dark); font-size: 0.85rem; margin-bottom: 3px;">{{ $inq->subject }}</div>
                                @endif
                                <p style="font-size: 0.82rem; color: var(--adm-text-main); line-height: 1.35;">{{ $inq->message }}</p>
                            </td>
                            <td>
                                <form action="{{ route('admin.inquiries.update-status', $inq) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="adm-form-control" style="padding: 4px 8px; font-size: 0.75rem; width: 100px;">
                                        <option value="new" {{ $inq->status == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="read" {{ $inq->status == 'read' ? 'selected' : '' }}>Read</option>
                                        <option value="replied" {{ $inq->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                    </select>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 6px;">
                                    @if($inq->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}" target="_blank" class="adm-btn adm-btn-accent adm-btn-sm" title="WhatsApp reply">💬</a>
                                    @endif
                                    <form action="{{ route('admin.inquiries.destroy', $inq) }}" method="POST" onsubmit="return confirm('Delete message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">✕</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--adm-text-muted);">
                                No contact inquiries received yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
        <div class="adm-pagination-container">
            {{ $inquiries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
