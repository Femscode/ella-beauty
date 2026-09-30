<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ThriveCity Studio') }} – Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- Vite assets (Tailwind + App JS) -->
<link rel="icon" href="{{ url('assets/images/logo.jpeg') }}" type="image/jpeg">
    
    <link rel="stylesheet" href="{{ url('assets/css/app1.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ url('assets/css/tailwind1.css') }}?v={{ time() }}">
    <script src="{{ url('assets/js/app.js') }}"></script>
    <script src="{{ url('assets/js/tailwind.js') }}"></script>

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin1.css') }}?v={{ time() }}">

    <!-- Page-specific styles -->
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-slate-50 flex">
        <!-- Sidebar -->
        <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-blue-900 to-indigo-950 text-white shadow-xl transform -translate-x-full transition-transform duration-200 md:translate-x-0 md:static md:flex md:flex-col">
            <div class="h-16 flex items-center px-6 border-b border-white/20">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img width="34" height="34" class="rounded-full object-cover border border-sky-400" src="{{ url('assets/images/logo.jpeg') }}" alt="Ella Beauty">
    
                    <span class="font-semibold text-lg">Ella Admin</span>
                </a>
            </div>

            <nav class="flex-1 py-4 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4" />
                    </svg>
                    <span>Orders</span>
                </a>
                <a href="{{ route('blog.index') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2zm3 4h4m-4 4h4m-4 4h4" />
                    </svg>
                    <span>Blogs</span>
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6M9 7h6" />
                    </svg>
                    <span>Products</span>
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19V6h2v13m-7-3h12" />
                    </svg>
                    <span>Analytics</span>
                </a>
                <a href="{{ route('admin.payments') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.567-3 3.5S10.343 15 12 15s3-1.567 3-3.5S13.657 8 12 8z" />
                    </svg>
                    <span>Payments</span>
                </a>
                <a href="{{ route('admin.delivery') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-7 4h8M8 8h10" />
                    </svg>
                    <span>Delivery</span>
                </a>
                <a href="{{ route('admin.password') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm-7 9v-2a5 5 0 015-5h4a5 5 0 015 5v2H5z" />
                    </svg>
                    <span>Reset Password</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 transition">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
               
            </nav>
        </aside>

        <!-- Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="bg-white/90 backdrop-blur border-b border-slate-200">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                    <div class="flex items-center gap-3">
                        @hasSection('header')
                            <div class="text-slate-800 font-semibold text-lg">@yield('header')</div>
                        @else
                            <div class="text-slate-800 font-semibold text-lg">Admin</div>
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden md:flex">
                            <div class="relative">
                                <input type="text" placeholder="Search..." class="w-64 rounded-md border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500" />
                                <span class="absolute right-2 top-2.5 text-slate-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                                </span>
                            </div>
                        </div>
                        <button id="sidebarToggle" class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-slate-700 hover:bg-slate-100 focus:outline-none" aria-label="Toggle sidebar">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Mobile overlay -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/40 z-30 md:hidden"></div>

    <!-- Page-specific scripts -->
    @stack('scripts')
    <script>
        (function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (!toggleBtn || !sidebar || !overlay) return;
            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                toggleBtn.setAttribute('aria-expanded', 'false');
            }
            toggleBtn.addEventListener('click', function() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
            overlay.addEventListener('click', closeSidebar);
            // Close on ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSidebar();
            });
        })();
    </script>
</body>

</html>