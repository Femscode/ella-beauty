@extends('admin.layout')

@section('title', 'Website Showcase Services')
@section('header_title', 'Homepage Showcase Services & Artistry Menu')

@section('content')
<div class="adm-section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
    <div>
        <h2 style="font-size: 1.3rem; font-weight: 700; color: #160D4A; margin-bottom: 4px;">Homepage Showcase Services ({{ $services->total() }})</h2>
        <p style="font-size: 0.85rem; color: #64748B;">
            These cards are displayed in the <strong>"Explore Our Hairstyling Services"</strong> section on the public homepage.
        </p>
    </div>
    <div style="display: flex; gap: 12px;">
        <a href="#addServiceCard" class="adm-btn adm-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>+ Add New Showcase Card</span>
        </a>
    </div>
</div>

<!-- List of Showcase Cards -->
<div class="adm-card" style="margin-bottom: 32px;">
    <div class="adm-card-header" style="background: #FAFBFD; border-bottom: 1px solid var(--adm-border); display: flex; justify-content: space-between; align-items: center;">
        <div class="adm-card-title" style="display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
            <span>Active Homepage Service Cards</span>
        </div>
        <span style="font-size: 0.8rem; color: #64748B;">Showing in custom sort order</span>
    </div>

    <div class="adm-card-body" style="padding: 0;">
        <div class="adm-table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Title & Category</th>
                        <th>Badge Pill</th>
                        <th>Price & Duration</th>
                        <th>Button & Link</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th style="text-align: right; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $ws)
                    <tr>
                        <td>
                            <div style="width: 56px; height: 56px; border-radius: 8px; overflow: hidden; background: #EEF2F6; border: 1px solid var(--adm-border);">
                                <img src="{{ $ws->image_url }}" alt="{{ $ws->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </td>
                        <td>
                            <strong style="color: #160D4A; font-size: 0.95rem;">{{ $ws->title }}</strong>
                            <div style="display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                                <span style="font-size: 0.75rem; background: #E0F2FE; color: #0369A1; padding: 2px 8px; border-radius: 6px; font-weight: 600;">
                                    {{ $ws->category_name ?? 'General' }} ({{ $ws->category_slug }})
                                </span>
                            </div>
                            @if($ws->description)
                            <div style="font-size: 0.78rem; color: #64748B; margin-top: 4px; max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $ws->description }}
                            </div>
                            @endif
                        </td>
                        <td>
                            @if($ws->badge)
                            <span style="font-size: 0.75rem; background: #FEF3C7; color: #B45309; padding: 3px 8px; border-radius: 20px; font-weight: 600; white-space: nowrap;">
                                {{ $ws->badge }}
                            </span>
                            @else
                            <span style="color: #94A3B8; font-size: 0.8rem;">—</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #160D4A; font-size: 0.9rem;">
                                <span style="font-size: 0.75rem; font-weight: normal; color: #64748B;">{{ $ws->price_prefix }}</span> {{ $ws->price_value }}
                            </div>
                            <div style="font-size: 0.75rem; color: #0284C7; font-weight: 600; margin-top: 2px;">
                                {{ $ws->duration ?? 'Standard' }}
                            </div>
                            @if($ws->deposit_tag)
                            <div style="font-size: 0.7rem; color: #059669; font-weight: 600;">
                                {{ $ws->deposit_tag }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.82rem; font-weight: 600; color: #160D4A;">{{ $ws->button_text ?? 'Book Now' }}</div>
                            <div style="font-size: 0.72rem; color: #64748B; font-family: monospace; max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $ws->button_link ?? '/booking' }}
                            </div>
                        </td>
                        <td>
                            <span style="font-weight: 700; color: #160D4A; font-size: 0.85rem;">{{ $ws->sort_order }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.website-services.toggle-active', $ws) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="adm-badge {{ $ws->is_active ? 'adm-badge-success' : 'adm-badge-warning' }}" style="cursor: pointer; border: none; font-size: 0.75rem; padding: 4px 10px;">
                                    {{ $ws->is_active ? '● Active' : '○ Hidden' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                <button type="button" class="adm-btn adm-btn-outline adm-btn-sm" onclick="openEditModal({{ json_encode($ws) }})" title="Edit Service">
                                    ✎ Edit
                                </button>
                                <form action="{{ route('admin.website-services.destroy', $ws) }}" method="POST" onsubmit="return confirm('Delete this showcase service card from the website?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm" title="Delete">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: var(--adm-text-muted);">
                            No website showcase services found. Add one below to display on the homepage.
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

<!-- Add New Showcase Service Card -->
<div class="adm-card" id="addServiceCard" style="max-width: 900px; margin-bottom: 40px;">
    <div class="adm-card-header" style="background: linear-gradient(135deg, #160D4A 0%, #271875 100%); color: #FFF; border-radius: 12px 12px 0 0;">
        <div>
            <div class="adm-card-title" style="color: #FFF;">+ Add New Website Showcase Service</div>
            <p style="font-size: 0.8rem; color: rgba(255,255,255,0.7); margin-top: 4px;">
                Fill out the fields to publish a new hairstyle card on the homepage services section.
            </p>
        </div>
    </div>
    <div class="adm-card-body" style="padding: 28px;">
        <form action="{{ route('admin.website-services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Service Title *</label>
                    <input type="text" name="title" class="adm-form-control" placeholder="e.g. Knotless Boho Braids" required value="{{ old('title') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Category Name (Tab Filter) *</label>
                    <input type="text" name="category_name" class="adm-form-control" placeholder="e.g. Braids, Twists, Kids' Hair, Protective Styles, Mobile & Travel" required value="{{ old('category_name') }}">
                    <small style="color: #64748B; font-size: 0.75rem;">Used to group and filter cards in the homepage tabs.</small>
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Badge Pill Text</label>
                    <input type="text" name="badge" class="adm-form-control" placeholder="e.g. ✦ Signature Braids" value="{{ old('badge') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Price Prefix</label>
                    <input type="text" name="price_prefix" class="adm-form-control" placeholder="e.g. From, Starting at, Luton Coverage" value="{{ old('price_prefix', 'From') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Price / Value *</label>
                    <input type="text" name="price_value" class="adm-form-control" placeholder="e.g. £80.00 or Mobile" required value="{{ old('price_value', '£80.00') }}">
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Duration / Highlights</label>
                    <input type="text" name="duration" class="adm-form-control" placeholder="e.g. ⏱ 4–10 hrs or Home Comfort" value="{{ old('duration') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Deposit Tag</label>
                    <input type="text" name="deposit_tag" class="adm-form-control" placeholder="e.g. 30% Deposit" value="{{ old('deposit_tag', '30% Deposit') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="adm-form-control" placeholder="0" value="{{ old('sort_order', 0) }}">
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Description</label>
                <textarea name="description" class="adm-form-control" rows="3" placeholder="Short description of this hairstyling service or offering...">{{ old('description') }}</textarea>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Button Text</label>
                    <input type="text" name="button_text" class="adm-form-control" placeholder="e.g. Book Braids" value="{{ old('button_text', 'Book Now') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Button Link / URL</label>
                    <input type="text" name="button_link" class="adm-form-control" placeholder="e.g. /booking?service=braids or https://..." value="{{ old('button_link', '/booking') }}">
                </div>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Upload Showcase Image</label>
                    <input type="file" name="image" class="adm-form-control" accept="image/*">
                    <small style="color: #64748B; font-size: 0.75rem;">JPG, PNG, WebP, AVIF up to 10MB.</small>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Or Image Asset / URL Path</label>
                    <input type="text" name="image_url" class="adm-form-control" placeholder="e.g. assets/images/hero2.jpg" value="{{ old('image_url') }}">
                </div>
            </div>

            <div style="margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_active" id="is_active_new" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                <label for="is_active_new" style="font-size: 0.9rem; font-weight: 600; cursor: pointer;">Display this card on the live website immediately</label>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 28px; font-size: 0.95rem;">
                    Save & Publish Showcase Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Service Modal -->
<div id="editModal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(4px);">
    <div style="background: #FFFFFF; border-radius: 16px; width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="background: linear-gradient(135deg, #160D4A 0%, #271875 100%); color: #FFF; padding: 20px 24px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 1.15rem; font-weight: 700; color: #FFF; margin: 0;">Edit Showcase Service Card</h3>
            <button type="button" onclick="closeEditModal()" style="background: transparent; border: none; color: #FFF; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Service Title *</label>
                    <input type="text" name="title" id="edit_title" class="adm-form-control" required>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Category Name *</label>
                    <input type="text" name="category_name" id="edit_category_name" class="adm-form-control" required>
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Badge Pill Text</label>
                    <input type="text" name="badge" id="edit_badge" class="adm-form-control">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Price Prefix</label>
                    <input type="text" name="price_prefix" id="edit_price_prefix" class="adm-form-control">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Price / Value *</label>
                    <input type="text" name="price_value" id="edit_price_value" class="adm-form-control" required>
                </div>
            </div>

            <div class="adm-grid-3">
                <div class="adm-form-group">
                    <label class="adm-form-label">Duration / Highlights</label>
                    <input type="text" name="duration" id="edit_duration" class="adm-form-control">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Deposit Tag</label>
                    <input type="text" name="deposit_tag" id="edit_deposit_tag" class="adm-form-control">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" id="edit_sort_order" class="adm-form-control">
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Description</label>
                <textarea name="description" id="edit_description" class="adm-form-control" rows="3"></textarea>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Button Text</label>
                    <input type="text" name="button_text" id="edit_button_text" class="adm-form-control">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Button Link / URL</label>
                    <input type="text" name="button_link" id="edit_button_link" class="adm-form-control">
                </div>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Change Image (Upload)</label>
                    <input type="file" name="image" class="adm-form-control" accept="image/*">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Or Image Asset / URL</label>
                    <input type="text" name="image_url" id="edit_image_url" class="adm-form-control">
                </div>
            </div>

            <div style="margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_active" id="edit_is_active" value="1" style="width: 18px; height: 18px; cursor: pointer;">
                <label for="edit_is_active" style="font-size: 0.9rem; font-weight: 600; cursor: pointer;">Display this card on the live website</label>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" class="adm-btn adm-btn-outline" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 10px 24px;">Update Showcase Card</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(service) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    form.action = `/admin/website-services/${service.id}`;
    document.getElementById('edit_title').value = service.title || '';
    document.getElementById('edit_category_name').value = service.category_name || '';
    document.getElementById('edit_badge').value = service.badge || '';
    document.getElementById('edit_price_prefix').value = service.price_prefix || 'From';
    document.getElementById('edit_price_value').value = service.price_value || '';
    document.getElementById('edit_duration').value = service.duration || '';
    document.getElementById('edit_deposit_tag').value = service.deposit_tag || '30% Deposit';
    document.getElementById('edit_sort_order').value = service.sort_order ?? 0;
    document.getElementById('edit_description').value = service.description || '';
    document.getElementById('edit_button_text').value = service.button_text || 'Book Now';
    document.getElementById('edit_button_link').value = service.button_link || '/booking';
    document.getElementById('edit_image_url').value = service.image && service.image.startsWith('assets/') ? service.image : '';
    document.getElementById('edit_is_active').checked = !!service.is_active;

    modal.style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close on outside click
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection
