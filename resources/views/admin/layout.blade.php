<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Ella Beauty</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Admin Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin1.css') }}?v={{ time() }}">
    @yield('styles')
</head>

<body>

    <!-- Sidebar Navigation -->
    <aside class="adm-sidebar" id="adminSidebar">
        <div class="adm-brand">
            <div class="adm-brand-logo">EB</div>
            <div class="adm-brand-text">
                <h2>Ella Beauty</h2>
                <span>Home Salon</span>
            </div>
        </div>

        <nav class="adm-nav">
            <div class="adm-nav-heading">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="adm-nav-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="adm-nav-heading">Appointments</div>
            <a href="{{ route('admin.appointments.index') }}" class="adm-nav-link {{ request()->routeIs('admin.appointments*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <circle cx="8" cy="15" r="1" fill="currentColor"></circle>
                    <circle cx="12" cy="15" r="1" fill="currentColor"></circle>
                    <circle cx="16" cy="15" r="1" fill="currentColor"></circle>
                </svg>
                <span>Calendar & Schedule</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="adm-nav-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span>All Bookings</span>
                @php $pCount = \App\Models\Booking::where('status', 'pending')->count(); @endphp
                @if($pCount > 0)
                <span class="adm-badge adm-badge-warning">{{ $pCount }}</span>
                @endif
            </a>

            <div class="adm-nav-heading">Catalog & Menu</div>
            <a href="{{ route('admin.services.index') }}" class="adm-nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                    <path d="M2 17l10 5 10-5"></path>
                    <path d="M2 12l10 5 10-5"></path>
                </svg>
                <span>Services & Pricing</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="adm-nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                <span>Categories</span>
            </a>
            <a href="{{ route('admin.website-services.index') }}" class="adm-nav-link {{ request()->routeIs('admin.website-services*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                <span>Website Services</span>
            </a>

            <div class="adm-nav-heading">Media & Content</div>
            <a href="{{ route('admin.gallery.index') }}" class="adm-nav-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span>Gallery</span>
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="adm-nav-link {{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span>Client Reviews</span>
            </a>
            <div class="adm-nav-heading">System & Users</div>
            <a href="{{ route('admin.users.index') }}" class="adm-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Users & Staff</span>
            </a>
        </nav>

        <div class="adm-user-strip">
            <div class="adm-user-info">
                <div class="adm-avatar">{{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}</div>
                <div class="adm-user-details">
                    <h4>{{ auth()->user()->name ?? 'Administrator' }}</h4>
                    <p>{{ auth()->user()->email ?? 'admin@gmail.com' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" title="Log Out" style="background:none; border:none; color:rgba(255,255,255,0.6); cursor:pointer; padding:6px; display:flex;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="adm-main">
        <!-- Top Bar -->
        <header class="adm-header">
            <div class="adm-header-left">
                <button class="adm-toggle-menu" id="toggleSidebar">☰</button>
                <h1 class="adm-page-title">@yield('header_title', 'Dashboard')</h1>
            </div>
            <div class="adm-header-right">
                <a href="{{ route('home') }}" target="_blank" class="adm-btn-site">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    <span>View Website</span>
                </a>
            </div>
        </header>

        <!-- Page Body -->
        <div class="adm-body">
            @if(session('success'))
            <div class="adm-alert adm-alert-success">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error') || $errors->any())
            <div class="adm-alert adm-alert-danger">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div>
                    @if(session('error'))
                    <p>{{ session('error') }}</p>
                    @endif
                    @if($errors->any())
                    <ul style="margin-left: 16px; margin-top: 4px;">
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        document.getElementById('toggleSidebar')?.addEventListener('click', function() {
            document.getElementById('adminSidebar')?.classList.toggle('open');
        });
    </script>
    @yield('scripts')
</body>

</html>