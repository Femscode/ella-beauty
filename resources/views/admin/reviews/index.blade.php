@extends('admin.layout')

@section('title', 'Client Reviews')
@section('header_title', 'Client Reviews & Testimonials')

@section('content')
<div class="adm-grid-2">
    <!-- Reviews List -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">Reviews ({{ $reviews->total() }})</div>
        </div>
        <div class="adm-card-body" style="padding: 0;">
            <div class="adm-table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Client & Rating</th>
                            <th>Review Comment</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $rev)
                            <tr>
                                <td>
                                    <strong>{{ $rev->client_name }}</strong>
                                    <div style="color: #F59E0B; font-size: 0.85rem;">
                                        @for($i = 0; $i < $rev->rating; $i++) ★ @endfor
                                    </div>
                                    <div style="font-size: 0.72rem; color: var(--adm-text-muted);">{{ $rev->service_rendered }}</div>
                                </td>
                                <td>
                                    <p style="font-size: 0.82rem; line-height: 1.35; color: var(--adm-text-main);">"{{ Str::limit($rev->comment, 100) }}"</p>
                                </td>
                                <td>
                                    @if($rev->is_approved)
                                        <span class="status-pill status-completed">Published</span>
                                    @else
                                        <span class="status-pill status-pending">Pending</span>
                                    @endif
                                    @if($rev->is_featured)
                                        <div style="margin-top: 4px;"><span class="adm-badge" style="font-size: 0.65rem;">Featured</span></div>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <form action="{{ route('admin.reviews.toggle-approve', $rev) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="adm-btn adm-btn-outline adm-btn-sm" title="Toggle visibility">
                                                {{ $rev->is_approved ? 'Hide' : 'Approve' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reviews.destroy', $rev) }}" method="POST" onsubmit="return confirm('Delete review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">✕</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 32px; color: var(--adm-text-muted);">
                                    No reviews yet. Add a testimonial using the form.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reviews->hasPages())
            <div class="adm-pagination-container">
                {{ $reviews->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Add Review Form -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">+ Add Client Review</div>
        </div>
        <div class="adm-card-body">
            <form action="{{ route('admin.reviews.store') }}" method="POST">
                @csrf

                <div class="adm-form-group">
                    <label class="adm-form-label">Client Name *</label>
                    <input type="text" name="client_name" class="adm-form-control" required placeholder="e.g. Amara K.">
                </div>

                <div class="adm-grid-2">
                    <div class="adm-form-group">
                        <label class="adm-form-label">Rating (1 - 5 Stars) *</label>
                        <select name="rating" class="adm-form-control" required>
                            <option value="5" selected>★★★★★ (5 Stars)</option>
                            <option value="4">★★★★☆ (4 Stars)</option>
                            <option value="3">★★★☆☆ (3 Stars)</option>
                        </select>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-form-label">Hairstyle Service</label>
                        <input type="text" name="service_rendered" class="adm-form-control" placeholder="e.g. Mid-Back Boho Braids">
                    </div>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Client Feedback / Comment *</label>
                    <textarea name="comment" class="adm-form-control" required placeholder="Paste client testimonial here..."></textarea>
                </div>

                <div class="adm-form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_featured" value="1" checked>
                        <span style="font-size: 0.9rem; font-weight: 600;">Feature on Landing Page</span>
                    </label>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="adm-btn adm-btn-primary">Save Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
