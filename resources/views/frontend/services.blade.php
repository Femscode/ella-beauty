@extends('frontend.master')

@section('header')
<link rel="stylesheet" href="{{ url('assets/css/services.css') }}?v={{ time() }}">
@endsection

@section('content')
<!-- ==========================================================================
     1. LUXURY SERVICES HERO SECTION
     ========================================================================== -->
<section class="services-hero-redesign">
    <div class="services-hero-inner">
        <div class="services-pill-tag">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <span>Ella Beauty Artistry</span>
        </div>

        <h1 class="services-hero-title">
            Our <span>Services</span> 👑
        </h1>

        <p class="services-hero-subtitle">
            From precision braided masterpieces to gentle protective styles, mobile home visits, and travel appointments — discover bespoke hair care designed to make you love your crown.
        </p>

        <div class="services-hero-actions">
            <button type="button" class="btn-hero-primary" onclick="openBookingModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span>Book Your Appointment</span>
            </button>
            <a href="#servicesGrid" class="btn-hero-secondary">
                <span>Explore Styles</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="19 12 12 19 5 12"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     2. SERVICES CATALOG & EDITORIAL SHOWCASE
     ========================================================================== -->
<section class="services-catalog-section" id="servicesGrid">
    <div class="services-catalog-container">
        
        <!-- Header -->
        <div class="section-intro-header">
            <span class="section-badge-eyebrow">Signature Offerings</span>
            <h2 class="section-main-heading">Crafted With <span>Heart & Precision</span></h2>
            <p class="section-main-desc">
                Every style is customized for comfort, neatness, tension-free edge protection, and lasting elegance.
            </p>
        </div>

        @php
            $mainServices = $websiteServices->filter(fn($ws) => $ws->category_slug !== 'mobile');
            $specialServices = $websiteServices->filter(fn($ws) => $ws->category_slug === 'mobile');
        @endphp

        <!-- Primary Hair Style Categories -->
        <div class="services-editorial-grid">
            @forelse($mainServices as $ws)
            <div class="service-luxury-card">
                <div class="service-card-top-image">
                    @if($ws->badge)
                    <span class="service-card-tag">{{ $ws->badge }}</span>
                    @endif
                    <img src="{{ $ws->image_url }}" alt="{{ $ws->title }} by Ella Beauty" loading="lazy">
                </div>
                <div class="service-card-content">
                    <div class="service-card-header-row">
                        <h3 class="service-title-primary">{{ strtoupper($ws->title) }}</h3>
                        <div class="service-icon-indicator" title="{{ $ws->title }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.85rem; font-size: 0.925rem;">
                        <span style="color: #2563EB; font-weight: 800;">
                            {{ $ws->price_prefix }} <strong style="font-size: 1.05rem;">{{ $ws->price_value }}</strong>
                        </span>
                        @if($ws->duration)
                        <span style="color: #CBD5E1;">•</span>
                        <span style="color: #64748B; font-weight: 600; font-size: 0.85rem;">{{ $ws->duration }}</span>
                        @endif
                        @if($ws->deposit_tag)
                        <span style="background: #EBF3FC; color: #271875; padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid rgba(56,189,248,0.3);">{{ $ws->deposit_tag }}</span>
                        @endif
                    </div>

                    @if($ws->description)
                    <p class="service-card-description">
                        {{ $ws->description }}
                    </p>
                    @endif

                    @if($ws->category_name)
                    <div class="service-style-pills">
                        <span class="style-pill">{{ $ws->category_name }}</span>
                        <span class="style-pill">Tension-Free</span>
                        <span class="style-pill">Neat Parting</span>
                        <span class="style-pill">Edge Protection</span>
                    </div>
                    @endif

                    @php
                        $btnUrl = $ws->button_link;
                        if (empty($btnUrl)) {
                            $btnUrl = route('booking');
                        } elseif (str_starts_with($btnUrl, 'http://') || str_starts_with($btnUrl, 'https://')) {
                            // full url
                        } elseif (str_starts_with($btnUrl, '/')) {
                            $btnUrl = url($btnUrl);
                        } else {
                            $btnUrl = route('booking') . '?service=' . urlencode($btnUrl);
                        }
                    @endphp

                    <div class="service-card-footer">
                        <a href="{{ $btnUrl }}" class="btn-book-service-card" style="text-decoration: none;">
                            <span>{{ $ws->button_text ?? 'Book ' . $ws->title }}</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #64748B;">
                <p>No services currently available.</p>
            </div>
            @endforelse
        </div>

        @if($specialServices->isNotEmpty())
        <!-- Dedicated Special Service Spotlights: Mobile & Travel Appointments -->
        <div class="services-special-section">
            <div class="special-services-grid">
                @foreach($specialServices as $ss)
                @php
                    $btnUrl = $ss->button_link;
                    if (empty($btnUrl)) {
                        $btnUrl = route('booking');
                    } elseif (str_starts_with($btnUrl, 'http://') || str_starts_with($btnUrl, 'https://')) {
                        // full url
                    } elseif (str_starts_with($btnUrl, '/')) {
                        $btnUrl = url($btnUrl);
                    } else {
                        $btnUrl = route('booking') . '?service=' . urlencode($btnUrl);
                    }
                @endphp
                <div class="special-service-card">
                    <div class="special-card-glow"></div>
                    <div>
                        @if($ss->badge)
                        <div class="special-card-badge">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>{{ $ss->badge }}</span>
                        </div>
                        @endif
                        <h3 class="special-card-title">{{ strtoupper($ss->title) }}</h3>
                        <p class="special-card-text">
                            {{ $ss->description }}
                        </p>
                        <ul class="special-card-perks">
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>{{ $ss->price_prefix }} <strong>{{ $ss->price_value }}</strong></span>
                            </li>
                            @if($ss->duration)
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>{{ $ss->duration }}</span>
                            </li>
                            @endif
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>All braiding tools and premium equipment brought to you</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ $btnUrl }}" class="btn-special-book" style="text-decoration: none;">
                            <span>{{ $ss->button_text ?? 'Book ' . $ss->title }}</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

<!-- ==========================================================================
     3. 3-STEP SEAMLESS BOOKING PROCESS
     ========================================================================== -->
<section class="services-flow-section">
    <div class="container">
        <div class="section-intro-header" style="margin-bottom: 2rem;">
            <span class="section-badge-eyebrow">How It Works</span>
            <h2 class="section-main-heading">Simple <span>3-Step</span> Booking</h2>
            <p class="section-main-desc">
                From selecting your dream style to sitting back while we transform your hair.
            </p>
        </div>

        <div class="flow-grid">
            <div class="flow-step-card">
                <div class="flow-step-number">1</div>
                <h4>Select Your Style</h4>
                <p>Choose your preferred braiding, twist, kid, or protective style, or request a custom look from your camera roll.</p>
            </div>

            <div class="flow-step-card">
                <div class="flow-step-number">2</div>
                <h4>Choose Date & Location</h4>
                <p>Pick your date and decide whether you want a studio visit, home service in Luton, or a travel appointment.</p>
            </div>

            <div class="flow-step-card">
                <div class="flow-step-number">3</div>
                <h4>Relax & Slay</h4>
                <p>Enjoy gentle, tension-free precision parting and styling that leaves you confident and radiant.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. FINAL CALL TO ACTION
     ========================================================================== -->
<section class="services-final-banner">
    <div class="final-banner-inner">
        <h2>Your Hair. Your Crown. Your Style. 👑</h2>
        <p>
            Ready to book your next protective style with Ella Beauty? Reserve your appointment now and experience the difference.
        </p>
        <button type="button" class="btn-banner-cta" onclick="openBookingModal()">
            <span>✨ Book Appointment Now</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</section>
@endsection
