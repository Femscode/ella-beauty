@extends('admin.layout')

@section('title', 'Service Categories')
@section('header_title', 'Hairstyle Categories (9 Collections)')

@section('content')
<div class="adm-grid-2">
    <!-- Categories List -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">Active Categories</div>
        </div>
        <div class="adm-card-body" style="padding: 0;">
            <div class="adm-table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Services Count</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td>{{ $cat->sort_order }}</td>
                                <td>
                                    <strong>{{ $cat->name }}</strong>
                                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $cat->slug }}</div>
                                </td>
                                <td>
                                    <span class="adm-badge">{{ $cat->services_count }} services</span>
                                </td>
                                <td style="text-align: right;">
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete category?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">✕</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">+ Add New Category</div>
        </div>
        <div class="adm-card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="adm-form-group">
                    <label class="adm-form-label">Category Title *</label>
                    <input type="text" name="name" class="adm-form-control" required placeholder="e.g. Butterfly Locs">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Description</label>
                    <textarea name="description" class="adm-form-control" placeholder="Short overview of the category style..."></textarea>
                </div>

                <div class="adm-grid-2">
                    <div class="adm-form-group">
                        <label class="adm-form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="adm-form-control" value="{{ $categories->count() + 1 }}">
                    </div>
                    <div class="adm-form-group" style="display: flex; align-items: flex-end; padding-bottom: 8px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" checked>
                            <span style="font-size: 0.9rem; font-weight: 600;">Active in Menu</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="adm-btn adm-btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
