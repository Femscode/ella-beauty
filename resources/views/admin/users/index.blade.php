@extends('admin.layout')

@section('title', 'Users & Staff')
@section('header_title', 'Users, Clients & Admin Staff')

@section('content')
<div class="adm-grid-2">
    <!-- Users Table -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">Registered Accounts ({{ $users->total() }})</div>
        </div>
        <div class="adm-card-body" style="padding: 0;">
            <div class="adm-table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Registered</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $usr)
                            <tr>
                                <td>
                                    <strong>{{ $usr->name }}</strong>
                                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $usr->email }}</div>
                                    @if($usr->phone)
                                        <div style="font-size: 0.72rem; color: var(--adm-text-muted);">{{ $usr->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-pill {{ $usr->role === 'admin' ? 'status-confirmed' : 'status-completed' }}">
                                        {{ $usr->role }}
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 0.78rem;">{{ $usr->created_at->format('d M Y') }}</div>
                                </td>
                                <td style="text-align: right;">
                                    @if($usr->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $usr) }}" method="POST" onsubmit="return confirm('Delete user account?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">✕</button>
                                        </form>
                                    @else
                                        <span style="font-size: 0.75rem; color: var(--adm-text-muted); font-style: italic;">You</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
            <div class="adm-pagination-container">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Create User Account Form -->
    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">+ Create New Admin / User Account</div>
        </div>
        <div class="adm-card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="adm-form-group">
                    <label class="adm-form-label">Full Name *</label>
                    <input type="text" name="name" class="adm-form-control" required placeholder="e.g. Femi Fasanya" value="{{ old('name') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Email Address *</label>
                    <input type="email" name="email" class="adm-form-control" required placeholder="admin@example.com" value="{{ old('email') }}">
                </div>

                <div class="adm-grid-2">
                    <div class="adm-form-group">
                        <label class="adm-form-label">Phone Number</label>
                        <input type="text" name="phone" class="adm-form-control" placeholder="+44 7424 928399" value="{{ old('phone') }}">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-form-label">Role *</label>
                        <select name="role" class="adm-form-control" required>
                            <option value="admin">Administrator</option>
                            <option value="staff">Staff / Braider</option>
                            <option value="client">Client</option>
                        </select>
                    </div>
                </div>

                <div class="adm-form-group">
                    <label class="adm-form-label">Password *</label>
                    <input type="password" name="password" class="adm-form-control" required placeholder="Min 8 characters">
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="adm-btn adm-btn-primary">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
