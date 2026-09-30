@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Management Dashboard') }}
        </h2>
    </div>
@endsection

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto dash-page">
            @push('styles')
                <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
            @endpush

            <div class="dash-stats-row">
                <div class="dash-card">
                    <div class="flex items-center">
                        <div class="dash-icon dash-icon-primary">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                            </svg>
                        </div>
                        <div class="dash-ml-4">
                            <p class="dash-label">Total Orders</p>
                            <p class="dash-value dash-value-primary">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="flex items-center">
                        <div class="dash-icon dash-icon-blue">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 12h12M9 17h6" />
                            </svg>
                        </div>
                        <div class="dash-ml-4">
                            <p class="dash-label">Total Products</p>
                            <p class="dash-value dash-value-blue">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="flex items-center">
                        <div class="dash-icon dash-icon-green">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <div class="dash-ml-4">
                            <p class="dash-label">Total Categories</p>
                            <p class="dash-value dash-value-green">{{ $totalCategories }}</p>
                        </div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="flex items-center">
                        <div class="dash-icon dash-icon-yellow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V8l-4-4H7z" />
                            </svg>
                        </div>
                        <div class="dash-ml-4">
                            <p class="dash-label">Total Blogs</p>
                            <p class="dash-value dash-value-yellow">{{ $totalBlogs }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <div class="dash-card">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="dash-icon dash-icon-orange">
                                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7l1 12h12l1-12M8 10h2m4 0h2" />
                                </svg>
                            </div>
                            <div>
                                <p class="dash-label">Marketplace</p>
                                <p class="text-slate-900 font-semibold text-lg">Share your shop link with customers</p>
                                <p class="text-slate-500 text-sm mt-1">Copy the URL or preview the marketplace page in one click.</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 md:w-96">
                            <div class="flex items-center gap-2">
                                <input
                                    id="marketplace-url-input"
                                    type="text"
                                    readonly
                                    class="flex-1 border border-slate-300 rounded px-3 py-2 text-sm bg-slate-50"
                                    value="{{ route('marketplace') }}"
                                >
                                <button
                                    type="button"
                                    id="marketplace-copy-btn"
                                    class="btn-outline text-sm whitespace-nowrap"
                                >
                                    Copy Link
                                </button>
                            </div>
                            <a
                                href="{{ route('marketplace') }}"
                                target="_blank"
                                class="btn-gradient inline-flex justify-center items-center gap-2 text-sm"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15l6-6M7 7h10v10" />
                                </svg>
                                <span>View Marketplace</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold brand-text-primary">Recent Blogs</h3>
                        <a href="{{ route('blog.index') }}" class="btn-outline">Manage Blogs</a>
                    </div>
                    <ul class="space-y-3">
                        @forelse($recentBlogs as $blog)
                            <li class="flex items-center justify-between">
                                <span class="text-slate-700">{{ $blog->title }}</span>
                                <span class="text-slate-500 text-sm">{{ $blog->created_at->format('M d, Y') }}</span>
                            </li>
                        @empty
                            <li class="text-slate-500">No recent blogs.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold brand-text-primary mb-4">Quick Actions</h3>
                    <div class="quick-actions-grid">
                        <a href="{{ route('products.index') }}" class="quick-action">
                            <span class="quick-action-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4m-4 0H6a2 2 0 00-2 2v6m0 4a2 2 0 002 2h12a2 2 0 002-2v-4" />
                                </svg>
                            </span>
                            <span>Manage Products</span>
                        </a>
                        <a href="{{ route('categories.index') }}" class="quick-action">
                            <span class="quick-action-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                            <span>Manage Categories</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="quick-action">
                            <span class="quick-action-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                </svg>
                            </span>
                            <span>View Orders</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('marketplace-url-input');
            var btn = document.getElementById('marketplace-copy-btn');
            if (!input || !btn) return;
            btn.addEventListener('click', function () {
                var url = input.value;
                if (!url) return;
                var originalText = btn.textContent;
                var setCopiedState = function () {
                    btn.textContent = 'Copied!';
                    btn.disabled = true;
                    setTimeout(function () {
                        btn.textContent = originalText;
                        btn.disabled = false;
                    }, 1500);
                };
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(setCopiedState);
                } else {
                    input.focus();
                    input.select();
                    try {
                        document.execCommand('copy');
                        setCopiedState();
                    } catch (e) {}
                }
            });
        });
    </script>
@endpush
