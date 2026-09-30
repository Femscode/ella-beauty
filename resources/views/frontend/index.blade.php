@extends('frontend.master')

@section('header')
<link rel="stylesheet" href="{{ url('assets/css/index1.css') }}?v={{ time() }}">
@endsection

@section('content')
<!-- ==========================================================================
     HERO CAROUSEL WITH BACKGROUND & TEXT OVERLAY
     (Images can be easily replaced by changing the img src below)
     ========================================================================== -->
<section class="hero-carousel-wrapper" id="heroCarousel">
    <!-- Slide 1: Neat & Beautiful Braiding -->
    <div class="hero-slide active" data-slide-index="0">
        <img src="{{ url('assets/images/hero1.jpg') }}" alt="Braiding by Ella Beauty" class="hero-bg-img">
        <div class="hero-overlay-mask"></div>
        <div class="container">
            <div class="hero-slide-content">
                <h1 class="hero-slide-title">Beautifully Braided, <span class="highlight-gold">Confidently YOU</span></h1>
                <p class="hero-slide-desc">
                    Beautiful braids, protective styles and kids' hair, created with care and attention to detail.
                </p>
                <div class="hero-slide-actions">
                    <button class="btn-primary-gold" onclick="openBookingModal('Knotless Braids')">
                        <span>Book Appointment</span>
                    </button>
                    <a href="#services" class="btn-hero-glass">
                        <span>Explore Services</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 2: Flawless Knotless Braids -->
    <div class="hero-slide" data-slide-index="1">
        <img src="{{ url('assets/images/hero2.jpg') }}" alt="Knotless Braids" class="hero-bg-img">
        <div class="hero-overlay-mask"></div>
        <div class="container">
            <div class="hero-slide-content">
                <h2 class="hero-slide-title">Flawless <span class="highlight-gold">Knotless Braids</span></h2>
                <p class="hero-slide-desc">
                    Lightweight, painless styling crafted with care and neat precision.
                </p>
                <div class="hero-slide-actions">
                    <button class="btn-primary-gold" onclick="openBookingModal('Bohemian Knotless Braids')">
                        <span>Book Appointment</span>
                    </button>
                    <a href="#services" class="btn-hero-glass">
                        <span>Explore Services</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 3: Mobile Home Service -->
    <div class="hero-slide" data-slide-index="2">
        <img src="{{ url('assets/images/hero3.avif') }}" alt="Mobile Braiding Service" class="hero-bg-img">
        <div class="hero-overlay-mask"></div>
        <div class="container">
            <div class="hero-slide-content">
                <h2 class="hero-slide-title">Mobile <span class="highlight-gold">Home Service</span></h2>
                <p class="hero-slide-desc">
                    Bringing the professional braiding experience directly to your home.
                </p>
                <div class="hero-slide-actions">
                    <button class="btn-primary-gold" onclick="openBookingModal('Mobile Braiding')">
                        <span>Book Home Visit</span>
                    </button>
                    <a href="#services" class="btn-hero-glass">
                        <span>Explore Services</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 4: Gentle Kids Braiding -->
    <div class="hero-slide" data-slide-index="3">
        <img src="{{ url('assets/images/hero4.jpg') }}" alt="Kids and Family Braiding" class="hero-bg-img">
        <div class="hero-overlay-mask"></div>
        <div class="container">
            <div class="hero-slide-content">
                <h2 class="hero-slide-title">Gentle <span class="highlight-gold">Kids Braiding</span></h2>
                <p class="hero-slide-desc">
                    Comfortable, patient hair styling for children and teens.
                </p>
                <div class="hero-slide-actions">
                    <button class="btn-primary-gold" onclick="openBookingModal('Children & Family Braiding')">
                        <span>Book Appointment</span>
                    </button>
                    <a href="#services" class="btn-hero-glass">
                        <span>Explore Services</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Controls: Prev / Next Arrows -->
    <div class="carousel-nav-arrows">
        <button class="carousel-nav-btn prev" onclick="moveHeroSlide(-1)" aria-label="Previous Slide">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button class="carousel-nav-btn next" onclick="moveHeroSlide(1)" aria-label="Next Slide">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div>

    <!-- Carousel Dots -->
    <div class="carousel-dots-wrap">
        <div class="carousel-dot active" onclick="goToHeroSlide(0)" aria-label="Slide 1"></div>
        <div class="carousel-dot" onclick="goToHeroSlide(1)" aria-label="Slide 2"></div>
        <div class="carousel-dot" onclick="goToHeroSlide(2)" aria-label="Slide 3"></div>
        <div class="carousel-dot" onclick="goToHeroSlide(3)" aria-label="Slide 4"></div>
    </div>

    <!-- Scroll Indicator -->

</section>

<!-- ========================================================================
     STATS / TRUST BAR
     ======================================================================== -->
<div class="stats-trust-bar" id="stats-bar">
    <div class="container">
        <div class="stats-trust-grid">
            <div class="stat-trust-item">
                <span class="stat-trust-num">5.0</span>
                <span class="stat-trust-stars">★★★★★</span>
                <span class="stat-trust-label">Client Rating</span>
            </div>
            <div class="stat-trust-item">
                <span class="stat-trust-num">500+</span>
                <span class="stat-trust-label">Happy Clients Served</span>
            </div>
            <div class="stat-trust-item">
                <span class="stat-trust-num">25+</span>
                <span class="stat-trust-label">Signature Styles</span>
            </div>
            <div class="stat-trust-item">
                <span class="stat-trust-num">Mobile</span>
                <span class="stat-trust-label">Home Service Available</span>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     SERVICES & BESPOKE HAIRSTYLING MENU - LUXURY REDESIGN
     ========================================================================== -->
<section class="section-services" id="services">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span>Signature Artistry Menu</span>
            </span>
            <h2 class="section-title">
                Explore Our <span>Hairstyling Services</span>
            </h2>
            <p class="section-subtitle">
                Bespoke protective styling, precision braiding, and specialized hair care crafted with scalp-gentle techniques. Available in Luton and via mobile home service.
            </p>
        </div>

        @php
        $uniqueCategories = $websiteServices->groupBy('category_slug')->map(function($items) {
        return [
        'name' => $items->first()->category_name ?? 'General',
        'slug' => $items->first()->category_slug ?? 'general',
        'count' => $items->count(),
        ];
        });
        @endphp

        <!-- Service Category Tabs -->
        <div class="services-tabs-wrap">
            <button class="tab-btn active" onclick="filterServices('all', this)">
                <span>All Styles ({{ $websiteServices->count() }})</span>
            </button>
            @foreach($uniqueCategories as $slug => $cat)
            @if($slug)
            <button class="tab-btn" onclick="filterServices('{{ $slug }}', this)">
                <span>{{ $cat['name'] }}</span>
            </button>
            @endif
            @endforeach
        </div>

        <!-- Services Grid -->
        <div class="services-grid" id="servicesGrid">
            @forelse($websiteServices as $ws)
            <div class="service-card" data-category="{{ $ws->category_slug }}">
                <div class="service-thumb">
                    <img src="{{ $ws->image_url }}" alt="{{ $ws->title }} by Ella Beauty">
                    <div class="service-thumb-overlay"></div>
                    @if($ws->badge)
                    <span class="service-badge-pill">{{ $ws->badge }}</span>
                    @endif
                </div>
                <div class="service-body">
                    <h3 class="service-title">{{ $ws->title }}</h3>

                    <div class="service-price-strip">
                        <span>{{ $ws->price_prefix }} <strong class="price-val">{{ $ws->price_value }}</strong></span>
                        @if($ws->duration)
                        <span style="color: #94A3B8;">•</span>
                        <span style="color: #64748B; font-weight: 600;">{{ $ws->duration }}</span>
                        @endif
                        @if($ws->deposit_tag)
                        <span class="deposit-tag">{{ $ws->deposit_tag }}</span>
                        @endif
                    </div>

                    @if($ws->description)
                    <p class="service-desc">
                        {{ $ws->description }}
                    </p>
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

                    <a href="{{ $btnUrl }}" class="btn-book-service-card">
                        <span>{{ $ws->button_text ?? 'Book Now' }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B;">
                <p>No showcase services currently published.</p>
            </div>
            @endforelse
        </div>

        <!-- Luxury Bottom Banner Showcase -->
        <div class="services-footer-banner">
            <div>
                <h3>Browse Our Full 25-Style Pricing Menu</h3>
                <p>
                    Check all lengths (shoulder, mid-back, waist), sizes (small, smedium, medium), hair inclusion details, and live 30% deposit calculation.
                </p>
            </div>
            <div class="services-footer-actions">
                <a href="{{ route('booking') }}#pricingMenu" class="btn-banner-primary">
                    <span>Full Price List</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="https://wa.me/447350166691?text=Hello%20Ella%20Beauty,%20I%20have%20an%20inquiry%20about%20your%20services." target="_blank" class="btn-banner-outline">
                    WhatsApp Us

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     GEL OR NO GEL - YOUR HAIR, YOUR PREFERENCE
     ========================================================================== -->
<section class="section-gel-preference" id="gel-preference">
    <div class="container">
        <div class="gel-pref-wrapper">
            <!-- Ambient Lighting Effects -->
            <div class="gel-pref-glow gel-pref-glow-1"></div>
            <div class="gel-pref-glow gel-pref-glow-2"></div>

            <div class="gel-pref-header">
                <h2 class="gel-pref-title">GEL OR NO GEL</h2>
                <h3 class="gel-pref-subtitle">YOUR HAIR, YOUR PREFERENCE 🤎</h3>
                <p class="gel-pref-intro">
                    At Ella Beauty, your comfort and individual style come first. We proudly offer braiding services with or without hair gel to suit your personal scalp and finish preferences.
                </p>
            </div>

            <!-- Dual Option Comparison Grid with Central Connector -->
            <div class="gel-options-container">
                <div class="gel-options-grid">

                    <!-- Option 1: With Gel -->
                    <div class="gel-option-card gel-card-with">

                        <div class="gel-card-header">
                            <div class="gel-card-icon-wrap with-gel">
                                <span class="gel-emoji">🌿</span>
                            </div>
                            <div>
                                <h4 class="gel-card-heading">With Hair Gel</h4>
                                <span class="gel-card-tagline">High-Definition Finish</span>
                            </div>
                        </div>

                        <p class="gel-card-text">
                            If you prefer a more laid, sleek, and ultra-defined finish, professional hair gel can be seamlessly applied where appropriate to sculpt neat lines.
                        </p>


                    </div>

                    <!-- OR Badge for Desktop/Mobile Divider -->
                    <div class="gel-or-badge">
                        <span>OR</span>
                    </div>

                    <!-- Option 2: Without Gel -->
                    <div class="gel-option-card gel-card-without">

                        <div class="gel-card-header">
                            <div class="gel-card-icon-wrap without-gel">
                                <span class="gel-emoji">🌿</span>
                            </div>
                            <div>
                                <h4 class="gel-card-heading">Without Hair Gel</h4>
                                <span class="gel-card-tagline">Natural Scalp Comfort</span>
                            </div>
                        </div>

                        <p class="gel-card-text">
                            If you prefer your braids completely free from gel, that's absolutely fine too. Just inform me before your appointment and enjoy a natural feel.
                        </p>

                    </div>

                </div>
            </div>

            <!-- Texture & Outcome Advisory Note -->
            <div class="gel-advisory-box">
                <div class="gel-advisory-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="gel-advisory-content">
                    <strong>Important Note:</strong>
                    <span>Please note that the final look can vary depending on your natural hair texture, condition, the chosen style and whether gel is used.</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================================================
     THE ELLA BEAUTY EXPERIENCE (4 PILLARS)
     ========================================================================== -->
<section class="section-experience" id="experience">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">The Salon Standard</span>
            <h2 class="section-title">Why Clients <span>Choose Ella Beauty</span></h2>
            <p class="section-subtitle">
                We believe your hair appointment should be a sanctuary of restorative wellness, luxury care, and immaculate artistry.
            </p>
        </div>

        <div class="experience-grid">
            <!-- Pillar 1 -->
            <div class="experience-card" data-num="01" data-reveal data-reveal-delay="100">
                <div class="exp-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h4>Tension-Free Promise</h4>
                <p>
                    Never dread tight or painful braiding again. We protect your delicate edges and hair follicles with gentle, lightweight grip techniques.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="experience-card" data-num="02" data-reveal data-reveal-delay="200">
                <div class="exp-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <h4>Mobile & Home Visits</h4>
                <p>
                    Enjoy full luxury braiding without leaving your living room. We bring the entire stylist kit directly to you across Luton and surrounding areas.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="experience-card" data-num="03" data-reveal data-reveal-delay="300">
                <div class="exp-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                    </svg>
                </div>
                <h4>Premium Hair Care</h4>
                <p>
                    We use premium pre-stretched, itch-free braiding hair paired with nourishing botanical oils to keep your hair healthy and moisturized.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="experience-card" data-num="04" data-reveal data-reveal-delay="400">
                <div class="exp-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <h4>Master Stylist Artistry</h4>
                <p>
                    Neat, symmetrical partings and clean styling tailored precisely to your unique curl texture, density, and preferred aesthetic.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     CLIENT TESTIMONIALS & SOCIAL PROOF
     ========================================================================== -->
<section class="section-reviews" id="reviews">
    <div class="container">
        <div class="section-header text-center">
            <div class="review-trust-pill">
                <span class="stars-gold">★★★★★</span>
                <span>5.0 Star Rated Salon & Mobile Experience</span>
            </div>
            <h2 class="section-title">Reviews from <span>my Queens</span></h2>
            <p class="section-subtitle">
                Authentic feedback from clients across Luton and surrounding areas who trust Ella Beauty for gentle scalp care, precision styling, and pristine finishes.
            </p>
        </div>

        <!-- Social Proof Stats Highlights -->
        <div class="reviews-stats-strip">
            <div class="review-stat-item">
                <span class="stat-num">5.0 ★</span>
                <span class="stat-label">Average Client Rating</span>
            </div>
            <div class="review-stat-divider"></div>
            <div class="review-stat-item">
                <span class="stat-num">100%</span>
                <span class="stat-label">Tension-Free & Gentle</span>
            </div>
            <div class="review-stat-divider"></div>
            <div class="review-stat-item">
                <span class="stat-num">Mobile</span>
                <span class="stat-label">& Travel Service Available</span>
            </div>
        </div>

        <!-- Dynamic Reviews Cards (Mobile-First Scroll / Desktop Grid) -->
        <div class="testimonials-scroll-wrapper">
            <div class="testimonials-grid">
                @forelse($reviews as $review)
                @php
                // Generate initials from client name
                $words = explode(' ', trim($review->client_name));
                $initials = '';
                foreach ($words as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
                }
                $initials = substr($initials, 0, 2) ?: 'EB';
                @endphp
                <div class="review-card">
                    <div class="review-quote-watermark">“</div>
                    <div class="review-card-top-content">
                        <div class="review-card-header">
                            <div class="review-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <=($review->rating ?? 5))
                                    <span class="star-filled">★</span>
                                    @else
                                    <span class="star-empty">☆</span>
                                    @endif
                                    @endfor
                            </div>
                            <span class="verified-client-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Verified Client
                            </span>
                        </div>
                        <p class="review-text">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <div class="client-meta">
                        @if($review->avatar)
                        <img src="{{ asset($review->avatar) }}" alt="{{ $review->client_name }}" class="client-photo-img">
                        @else
                        <div class="client-photo">{{ $initials }}</div>
                        @endif
                        <div class="client-details">
                            <h5 class="client-name">{{ $review->client_name }}</h5>
                            <span class="client-service">{{ $review->service_rendered ?: 'Braiding Client' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Fallback if database has no records yet -->
                <div class="review-card">
                    <div class="review-quote-watermark">“</div>
                    <div class="review-card-top-content">
                        <div class="review-card-header">
                            <div class="review-stars">
                                <span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span>
                            </div>
                            <span class="verified-client-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Verified Client
                            </span>
                        </div>
                        <p class="review-text">
                            "I usually get so much anxiety before getting braids because my scalp is sensitive. Ella was so incredibly gentle! Not a single headache, no tight edges, and the bohemian curls are still neat and gorgeous weeks later."
                        </p>
                    </div>
                    <div class="client-meta">
                        <div class="client-photo">VJ</div>
                        <div class="client-details">
                            <h5 class="client-name">Vanessa Johnson</h5>
                            <span class="client-service">Bohemian Knotless Braids</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-quote-watermark">“</div>
                    <div class="review-card-top-content">
                        <div class="review-card-header">
                            <div class="review-stars">
                                <span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span>
                            </div>
                            <span class="verified-client-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Verified Client
                            </span>
                        </div>
                        <p class="review-text">
                            "Having Ella come over for a home service was an absolute lifesaver. She arrived on time with everything needed, was patient with my daughter, and her braids look stunning. Best mobile stylist in Luton!"
                        </p>
                    </div>
                    <div class="client-meta">
                        <div class="client-photo">AL</div>
                        <div class="client-details">
                            <h5 class="client-name">Amara Lewis</h5>
                            <span class="client-service">Kids' Braids & Mobile Service</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-quote-watermark">“</div>
                    <div class="review-card-top-content">
                        <div class="review-card-header">
                            <div class="review-stars">
                                <span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span><span class="star-filled">★</span>
                            </div>
                            <span class="verified-client-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Verified Client
                            </span>
                        </div>
                        <p class="review-text">
                            "The precision partings and clean finish on my twists were unmatched. Everyone kept complimenting my hair at work. Professional, punctual, and worth every penny. Ella Beauty is my forever braider."
                        </p>
                    </div>
                    <div class="client-meta">
                        <div class="client-photo">ST</div>
                        <div class="client-details">
                            <h5 class="client-name">Stephanie Taylor</h5>
                            <span class="client-service">Passion Twists</span>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Social Proof Footer Banner -->
        <div class="reviews-footer-action">
            <div class="reviews-footer-content">
                <span class="reviews-footer-tag">Ready for your transformation?</span>
                <p>Book your appointment with Ella Beauty and experience bespoke, gentle hair artistry.</p>
            </div>
            <div class="reviews-footer-btns">
                <a href="{{ route('booking') }}" class="btn-banner-primary">
                    <span>Secure Your Date</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="https://wa.me/447350166691?text=Hello%20Ella%20Beauty,%20I%20would%20like%20to%20ask%20about%20your%20services." target="_blank" class="btn-banner-outline">
                    <span>Chat on WhatsApp</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ==========================================================================
     SALON FAQ ACCORDION
     ========================================================================== -->
<section class="section-faq" id="faq">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Helpful Answers</span>
            <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
            <p class="section-subtitle">
                Everything you need to know about booking your styling appointment, mobile visits, and hair care.
            </p>
        </div>

        <div class="faq-accordion">
            <!-- FAQ 1 -->
            <div class="faq-item active">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Where do you operate?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Ella Beauty serves clients in Luton and surrounding areas, with mobile/home-service and selected travel appointments available.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do you have a salon?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Ella Beauty currently operates primarily through mobile/home-service and travel appointments.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do you offer mobile braiding?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes. Ella Beauty can come to you for selected mobile/home-service appointments.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do you travel?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes. Travel appointments are available for selected locations. Additional travel charges may apply.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do you braid with gel?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes. Ella Beauty can braid with or without hair gel, depending on your preference and the chosen style.
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do I need to provide my own hair?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    This depends on the hairstyle. Please check the individual service information before booking.
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>How much is the deposit?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    A 30% deposit is required to secure your appointment. The remaining 70% balance is due according to the booking terms.
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>How do I book?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Select your desired hairstyle, check availability and follow the booking instructions.
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Can I change my hairstyle after booking?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Please contact Ella Beauty as soon as possible. Changes may affect the price and appointment duration.
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>What happens if I'm late?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Please contact me as soon as possible. Significant lateness may affect your appointment.
                </div>
            </div>

            <!-- FAQ 11 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Do you do children's hair?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes. Selected children's hairstyles are available.
                </div>
            </div>

            <!-- FAQ 12 -->
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Can you do very long or small braids?</h4>
                    <svg class="faq-icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, subject to availability. Smaller and longer styles require additional time and may have different pricing.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     VIP CTA BANNER
     ========================================================================== -->
<section class="section-cta">
    <div class="container">
        <div class="vip-banner" data-reveal>
            <!-- Animated sparkle particles -->
            <div class="vip-sparks" aria-hidden="true">
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
                <div class="vip-spark"></div>
            </div>
            <h2 class="vip-title">Ready for Your Next Hairstyle?</h2>
            <p class="vip-text">
                Experience gentle, neat, and detailed braiding designed to protect your hair and elevate your look. Book an in-studio appointment or reserve a mobile home visit today.
            </p>
            <div class="vip-actions">
                <button class="btn-vip-book" onclick="openBookingModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                    </svg>
                    <span>Book Your Appointment</span>
                </button>
                <a href="https://wa.me/447350166691?text=Hello%20Ella%20Beauty!%20I%20would%20like%20to%20inquire%20about%20booking%20a%20braiding%20appointment." target="_blank" class="btn-vip-chat">
                    <span>Chat on WhatsApp</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // ==========================================================================
    // HERO CAROUSEL CONTROLLER
    // ==========================================================================
    let currentHeroSlide = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.carousel-dot');
    let heroAutoTimer = null;

    function showHeroSlide(index) {
        if (!heroSlides.length) return;

        if (index >= heroSlides.length) {
            currentHeroSlide = 0;
        } else if (index < 0) {
            currentHeroSlide = heroSlides.length - 1;
        } else {
            currentHeroSlide = index;
        }

        heroSlides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === currentHeroSlide);
        });

        heroDots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === currentHeroSlide);
        });
    }

    function moveHeroSlide(direction) {
        showHeroSlide(currentHeroSlide + direction);
        resetHeroAutoTimer();
    }

    function goToHeroSlide(index) {
        showHeroSlide(index);
        resetHeroAutoTimer();
    }

    function startHeroAutoTimer() {
        clearInterval(heroAutoTimer);
        heroAutoTimer = setInterval(() => {
            showHeroSlide(currentHeroSlide + 1);
        }, 5500);
    }

    function resetHeroAutoTimer() {
        clearInterval(heroAutoTimer);
        startHeroAutoTimer();
    }

    // Attach hover & touch events to Carousel
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.getElementById('heroCarousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', () => clearInterval(heroAutoTimer));
            carousel.addEventListener('mouseleave', () => startHeroAutoTimer());

            // Touch Swipe Support for Mobile
            let startTouchX = 0;
            let endTouchX = 0;

            carousel.addEventListener('touchstart', (e) => {
                startTouchX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            carousel.addEventListener('touchend', (e) => {
                endTouchX = e.changedTouches[0].screenX;
                if (startTouchX - endTouchX > 45) {
                    moveHeroSlide(1); // Swipe left -> next
                } else if (endTouchX - startTouchX > 45) {
                    moveHeroSlide(-1); // Swipe right -> prev
                }
            }, {
                passive: true
            });
        }

        startHeroAutoTimer();
    });

    // Filter services by category
    function filterServices(category, btnElement) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');
        document.querySelectorAll('.service-card').forEach(card => {
            card.style.display = (category === 'all' || card.getAttribute('data-category') === category) ? 'flex' : 'none';
        });
    }

    // ==========================================================================
    // SCROLL REVEAL — IntersectionObserver
    // ==========================================================================
    (function() {
        const revealEls = document.querySelectorAll('[data-reveal]');
        if (!revealEls.length) return;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });
        revealEls.forEach(el => observer.observe(el));
    })();

    // Smooth scroll for scroll indicator
    document.addEventListener('DOMContentLoaded', () => {
        const scrollBtn = document.querySelector('.hero-scroll-indicator');
        if (scrollBtn) {
            scrollBtn.addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('stats-bar')?.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }
    });
</script>
@endsection