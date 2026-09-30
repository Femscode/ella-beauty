@extends('admin.layout')

@section('title', 'Lookbook & Gallery Management')
@section('header_title', 'Lookbook & Portfolio Media')

@section('content')
<!-- Filter & Action Header -->
<div class="adm-card" style="margin-bottom: 20px;">
    <div class="adm-card-body" style="padding: 18px 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.gallery.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end; flex: 1;">
                <div style="flex: 1; min-width: 200px;">
                    <label class="adm-form-label" style="margin-bottom: 4px; font-size: 0.75rem;">Search Title / Caption</label>
                    <input type="text" name="search" class="adm-form-control" placeholder="Search lookbook..." value="{{ request('search') }}">
                </div>

                <div style="width: 260px;">
                    <label class="adm-form-label" style="margin-bottom: 4px; font-size: 0.75rem;">Category</label>
                    <select name="service_category_id" class="adm-form-control">
                        <option value="">All Items (All Categories)</option>
                        <option value="uncategorized" {{ request('service_category_id') === 'uncategorized' ? 'selected' : '' }}>📷 General Lookbook / Uncategorized</option>
                        @foreach($serviceCategories as $sc)
                            <option value="{{ $sc->id }}" {{ request('service_category_id') == $sc->id ? 'selected' : '' }}>
                                🏷️ {{ $sc->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="adm-btn adm-btn-primary">Filter</button>
                    <a href="{{ route('admin.gallery.index') }}" class="adm-btn adm-btn-outline">Reset</a>
                </div>
            </form>

            <!-- Upload Trigger Button -->
            <div>
                <button onclick="document.getElementById('uploadDrawer').scrollIntoView({behavior:'smooth'})" class="adm-btn adm-btn-accent">
                    + Bulk / Single Upload Look
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Selection Action Bar (Appears when checkboxes are selected) -->
<div id="bulkActionBar" class="adm-card" style="display: none; background: #F0FDF4; border: 1.5px solid #86EFAC; margin-bottom: 20px; padding: 14px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        
        <!-- Left: Selected Count & Deselect -->
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="font-weight: 800; color: #166534; font-size: 0.95rem;">
                <span id="selectedCountDisplay">0</span> item(s) selected
            </span>
            <button type="button" onclick="toggleSelectAll(false)" class="adm-btn adm-btn-outline adm-btn-sm" style="background: #FFF;">Deselect All</button>
        </div>

        <!-- Middle: Bulk Classify / Categorize -->
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <span style="font-size: 0.82rem; font-weight: 700; color: #160D4A;">Bulk Classify:</span>
            <select id="bulkCategorySelect" class="adm-form-control" style="width: auto; min-width: 220px; padding: 6px 12px; font-size: 0.85rem; height: auto;">
                <option value="">-- No Category (General Lookbook) --</option>
                @foreach($serviceCategories as $sc)
                    <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                @endforeach
            </select>
            <button type="button" onclick="executeBulkClassify()" class="adm-btn adm-btn-primary adm-btn-sm" style="background: #0284C7; border-color: #0284C7;">
                🏷️ Assign Category
            </button>
        </div>

        <!-- Right: Bulk Delete -->
        <div>
            <button type="button" onclick="executeBulkDelete()" class="adm-btn adm-btn-danger adm-btn-sm">
                🗑️ Delete Selected Items
            </button>
        </div>
    </div>
</div>

<!-- Hidden forms for bulk actions -->
<form id="bulkDeleteForm" action="{{ route('admin.gallery.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
</form>

<form id="bulkClassifyForm" action="{{ route('admin.gallery.bulk-classify') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Single Delete Hidden Form -->
<form id="singleDeleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Media Items Grid -->
<div class="adm-card">
    <div class="adm-card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <label style="display: flex; align-items: center; gap: 6px; font-weight: 700; cursor: pointer; font-size: 0.88rem; color: var(--adm-primary-dark);">
                <input type="checkbox" id="masterSelectAll" onchange="toggleSelectAll(this.checked)" style="width: 18px; height: 18px; accent-color: var(--adm-accent-dark);">
                <span>Select All</span>
            </label>
            <div class="adm-card-title">Gallery Items ({{ $items->total() }})</div>
        </div>
        <div style="font-size: 0.8rem; color: var(--adm-text-muted);">
            Showing {{ $items->firstItem() ?? 0 }} - {{ $items->lastItem() ?? 0 }} of {{ $items->total() }}
        </div>
    </div>

    <div class="adm-card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 18px;">
            @forelse($items as $item)
                @php
                    $imgSrc = $item->image_url;
                @endphp
                <div style="border: 1.5px solid var(--adm-border); border-radius: 12px; overflow: hidden; background: #FFF; position: relative; display: flex; flex-direction: column; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s ease, border-color 0.2s ease;" class="gallery-card-item">
                    
                    <!-- Checkbox Overlay -->
                    <div style="position: absolute; top: 10px; left: 10px; z-index: 3; background: rgba(0,0,0,0.5); padding: 4px 8px; border-radius: 6px; backdrop-filter: blur(4px);">
                        <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="gallery-item-checkbox" onchange="handleItemCheck()" style="width: 18px; height: 18px; accent-color: var(--adm-accent-dark); cursor: pointer;">
                    </div>

                    <!-- Top Right Badges -->
                    <div style="position: absolute; top: 10px; right: 10px; z-index: 3; display: flex; flex-direction: column; gap: 4px; align-items: flex-end;">
                        @if($item->is_featured)
                            <span class="adm-badge" style="font-size: 0.68rem; background: rgba(39, 24, 117, 0.85); color: #FFF; border: none; backdrop-filter: blur(4px);">Featured</span>
                        @endif
                        @if($item->serviceCategory)
                            <span style="font-size: 0.65rem; background: #0284C7; color: #FFF; font-weight: 700; padding: 2px 6px; border-radius: 4px; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                🏷️ {{ $item->serviceCategory->name }}
                            </span>
                        @else
                            <span style="font-size: 0.65rem; background: #64748B; color: #FFF; font-weight: 600; padding: 2px 6px; border-radius: 4px;">
                                📷 General Look
                            </span>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div style="position: relative; height: 190px; background: #0B0626; overflow: hidden;">
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" onerror="this.src='{{ asset('assets/images/braided4.avif') }}'">
                    </div>

                    <!-- Metadata Info -->
                    <div style="padding: 12px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.92rem; color: var(--adm-primary-dark); line-height: 1.3; margin-bottom: 4px;">{{ $item->title }}</div>
                            <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 6px;">
                                @if($item->serviceCategory)
                                    <span style="font-size: 0.72rem; color: #0284C7; background: #E0F2FE; padding: 2px 8px; border-radius: 9999px; font-weight: 700;">
                                        🏷️ {{ $item->serviceCategory->name }}
                                    </span>
                                @else
                                    <span style="font-size: 0.72rem; color: #64748B; background: #F1F5F9; padding: 2px 8px; border-radius: 9999px; font-weight: 600;">
                                        📷 General Lookbook
                                    </span>
                                @endif

                                @if($item->sort_order > 0)
                                    <span style="font-size: 0.7rem; color: #64748B; background: #F1F5F9; padding: 2px 6px; border-radius: 4px;">
                                        Order: #{{ $item->sort_order }}
                                    </span>
                                @endif
                            </div>
                            @if($item->caption)
                                <div style="font-size: 0.78rem; color: var(--adm-text-muted); line-height: 1.4; margin-top: 4px; font-style: italic;">
                                    "{{ Str::limit($item->caption, 60) }}"
                                </div>
                            @endif
                        </div>

                        <!-- Actions Row -->
                        <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid var(--adm-border); display: flex; justify-content: space-between; align-items: center;">
                            <button type="button" class="adm-btn adm-btn-outline adm-btn-sm" onclick="openEditModal({{ json_encode($item) }})">
                                ✏️ Edit Look
                            </button>
                            
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="deleteSingleItem({{ $item->id }}, '{{ addslashes($item->title) }}')">
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 50px 20px; color: var(--adm-text-muted);">
                    <div style="font-size: 2.5rem; margin-bottom: 8px;">📷</div>
                    <p style="font-size: 1rem; font-weight: 600; color: #160D4A;">No lookbook images found matching your filter.</p>
                    <p style="font-size: 0.85rem; color: #64748B;">Upload photos below to showcase your braiding artistry.</p>
                </div>
            @endforelse
        </div>

        @if($items->hasPages())
        <div class="adm-pagination-container" style="margin-top: 24px; border-radius: 12px; border: 1px solid var(--adm-border);">
            {{ $items->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Upload New Lookbook Photo Form (Single & Bulk Support) -->
<div class="adm-card" id="uploadDrawer" style="max-width: 800px; margin-top: 24px;">
    <div class="adm-card-header" style="background: linear-gradient(135deg, #160D4A 0%, #271875 100%); color: #FFF; border-radius: 12px 12px 0 0;">
        <div>
            <div class="adm-card-title" style="color: #FFF;">+ Upload New Lookbook Artwork (Single or Bulk)</div>
            <p style="font-size: 0.82rem; color: #BAE6FD; margin: 2px 0 0;">Select hair photos to upload, optionally attach them to a hairstyle category, or leave as general lookbook photos.</p>
        </div>
    </div>
    <div class="adm-card-body">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="adm-form-group">
                <label class="adm-form-label">Look / Hairstyle Title (Optional)</label>
                <input type="text" name="title" class="adm-form-control" placeholder="e.g. Boho Knotless Goddess Braids (or leave blank to auto-generate)">
                <small style="color: var(--adm-text-muted); font-size: 0.75rem;">If uploading in bulk, each image will be numbered automatically with this title.</small>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Hairstyle Category (Optional)</label>
                    <select name="service_category_id" class="adm-form-control">
                        <option value="">-- No Category (General Lookbook) --</option>
                        @foreach($serviceCategories as $sc)
                            <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                        @endforeach
                    </select>
                    <small style="color: #0284C7; font-size: 0.74rem;">✨ Optional: If selected, this image will appear when this hairstyle category is chosen on the booking page.</small>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Sort / Display Order</label>
                    <input type="number" name="sort_order" class="adm-form-control" value="0">
                </div>
            </div>

            <div class="adm-form-group" style="display: flex; align-items: center;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" checked style="width: 18px; height: 18px; accent-color: var(--adm-accent-dark);">
                    <span style="font-size: 0.88rem; font-weight: 700; color: var(--adm-primary-dark);">Feature on Homepage & About Lookbook</span>
                </label>
            </div>

            <!-- Multiple File Upload (Bulk) -->
            <div class="adm-form-group" style="background: #F8FAFC; border: 2px dashed #BAE6FD; border-radius: 12px; padding: 20px; text-align: center;">
                <label class="adm-form-label" style="font-size: 1rem; color: #160D4A; margin-bottom: 6px;">Select Image(s) to Upload</label>
                <input type="file" name="images[]" multiple class="adm-form-control" accept="image/*" style="max-width: 450px; margin: 0 auto 8px;">
                <p style="font-size: 0.78rem; color: #64748B; margin: 0;">You can select one or multiple files at once (JPG, PNG, WEBP, AVIF • Max 10MB each).</p>
            </div>

            <!-- Alternative: Image URL -->
            <div class="adm-form-group">
                <label class="adm-form-label">Or Provide Single Image URL</label>
                <input type="text" name="image_url" class="adm-form-control" placeholder="https://images.unsplash.com/...">
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Caption / Maintenance Details (Optional)</label>
                <textarea name="caption" class="adm-form-control" rows="2" placeholder="e.g. Waist length, soft defined curls, lasting 6-8 weeks..."></textarea>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 28px; font-size: 0.95rem;">
                    Upload Lookbook Media
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Gallery Item Modal -->
<div id="editGalleryModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(11, 6, 38, 0.75); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #FFFFFF; border-radius: 16px; max-width: 600px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px rgba(0,0,0,0.3); border: 1.5px solid var(--adm-border);">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--adm-border); display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; border-radius: 16px 16px 0 0;">
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #160D4A; margin: 0;">Edit Lookbook Item</h3>
            <button type="button" onclick="closeEditModal()" style="background: none; border: none; font-size: 1.4rem; cursor: pointer; color: #64748B;">✕</button>
        </div>

        <form id="editGalleryForm" method="POST" enctype="multipart/form-data" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 20px; background: #F4F8FD; padding: 12px; border-radius: 10px; border: 1px solid #BAE6FD;">
                <img id="editImagePreview" src="" alt="Preview" style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover; background: #000;">
                <div>
                    <div style="font-weight: 700; color: #160D4A; font-size: 0.9rem;" id="editItemCurrentTitle">Title</div>
                    <small style="color: #64748B; font-size: 0.75rem;">Upload a new image below if you want to replace this photo.</small>
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Photo Title *</label>
                <input type="text" name="title" id="editTitleInput" class="adm-form-control" required>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group">
                    <label class="adm-form-label">Category (Optional)</label>
                    <select name="service_category_id" id="editServiceCategorySelect" class="adm-form-control">
                        <option value="">-- No Category (General Lookbook) --</option>
                        @foreach($serviceCategories as $sc)
                            <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Sort / Display Order</label>
                    <input type="number" name="sort_order" id="editSortOrderInput" class="adm-form-control">
                </div>
            </div>

            <div class="adm-grid-2">
                <div class="adm-form-group" style="display: flex; flex-direction: column; gap: 6px; padding-top: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_featured" id="editFeaturedCheck" value="1">
                        <span style="font-size: 0.85rem; font-weight: 700;">Featured in Lookbook</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_active" id="editActiveCheck" value="1">
                        <span style="font-size: 0.85rem; font-weight: 700;">Active / Visible</span>
                    </label>
                </div>
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Replace Image File (Optional)</label>
                <input type="file" name="image" class="adm-form-control" accept="image/*">
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Or Replace Image URL (Optional)</label>
                <input type="text" name="image_url" id="editImageUrlInput" class="adm-form-control" placeholder="https://...">
            </div>

            <div class="adm-form-group">
                <label class="adm-form-label">Caption / Description</label>
                <textarea name="caption" id="editCaptionTextarea" class="adm-form-control" rows="2"></textarea>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeEditModal()" class="adm-btn adm-btn-outline">Cancel</button>
                <button type="submit" class="adm-btn adm-btn-primary">Save Lookbook Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Handle Master Checkbox & Selection
    function toggleSelectAll(checked) {
        document.getElementById('masterSelectAll').checked = checked;
        document.querySelectorAll('.gallery-item-checkbox').forEach(cb => {
            cb.checked = checked;
        });
        updateBulkBar();
    }

    function handleItemCheck() {
        const checkboxes = document.querySelectorAll('.gallery-item-checkbox');
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        document.getElementById('masterSelectAll').checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
        updateBulkBar();
    }

    function updateBulkBar() {
        const checkboxes = document.querySelectorAll('.gallery-item-checkbox:checked');
        const bar = document.getElementById('bulkActionBar');
        const countDisplay = document.getElementById('selectedCountDisplay');
        
        if (checkboxes.length > 0) {
            countDisplay.textContent = checkboxes.length;
            bar.style.display = 'block';
        } else {
            bar.style.display = 'none';
        }
    }

    // Execute Bulk Classify (Assign Category)
    function executeBulkClassify() {
        const checkedBoxes = document.querySelectorAll('.gallery-item-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('Please select at least one gallery item to classify.');
            return;
        }

        const selectedCatId = document.getElementById('bulkCategorySelect').value;
        const catSelect = document.getElementById('bulkCategorySelect');
        const catText = selectedCatId ? catSelect.options[catSelect.selectedIndex].text : 'General Lookbook / Uncategorized';

        if (confirm(`Classify and assign ${checkedBoxes.length} selected item(s) to "${catText}"?`)) {
            const form = document.getElementById('bulkClassifyForm');
            form.innerHTML = '@csrf';
            
            const catInput = document.createElement('input');
            catInput.type = 'hidden';
            catInput.name = 'service_category_id';
            catInput.value = selectedCatId;
            form.appendChild(catInput);

            checkedBoxes.forEach(cb => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = cb.value;
                form.appendChild(input);
            });

            form.submit();
        }
    }

    // Execute Bulk Delete
    function executeBulkDelete() {
        const checkedBoxes = document.querySelectorAll('.gallery-item-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('Please select at least one gallery item to delete.');
            return;
        }

        if (confirm(`Are you sure you want to permanently delete all ${checkedBoxes.length} selected gallery images?`)) {
            const form = document.getElementById('bulkDeleteForm');
            form.innerHTML = '@csrf';

            checkedBoxes.forEach(cb => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = cb.value;
                form.appendChild(input);
            });

            form.submit();
        }
    }

    // Delete single item
    function deleteSingleItem(itemId, itemTitle) {
        if (confirm(`Are you sure you want to delete "${itemTitle}" from the gallery?`)) {
            const form = document.getElementById('singleDeleteForm');
            form.action = `/admin/gallery/${itemId}`;
            form.submit();
        }
    }

    // Edit Modal Handlers
    function openEditModal(item) {
        const modal = document.getElementById('editGalleryModal');
        const form = document.getElementById('editGalleryForm');
        
        form.action = `/admin/gallery/${item.id}`;
        document.getElementById('editItemCurrentTitle').textContent = item.title;
        document.getElementById('editTitleInput').value = item.title;
        if (document.getElementById('editServiceCategorySelect')) {
            document.getElementById('editServiceCategorySelect').value = item.service_category_id || '';
        }
        document.getElementById('editSortOrderInput').value = item.sort_order || 0;
        document.getElementById('editFeaturedCheck').checked = !!item.is_featured;
        document.getElementById('editActiveCheck').checked = (item.is_active !== undefined) ? !!item.is_active : true;
        document.getElementById('editCaptionTextarea').value = item.caption || '';
        document.getElementById('editImageUrlInput').value = '';

        const imgSrc = item.image_url || (item.image_path.startsWith('http') ? item.image_path : (item.image_path.startsWith('/') ? item.image_path : '/' + item.image_path));
        document.getElementById('editImagePreview').src = imgSrc;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        const modal = document.getElementById('editGalleryModal');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
</script>
@endsection
