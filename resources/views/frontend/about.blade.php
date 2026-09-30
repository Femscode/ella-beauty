@extends('frontend.master')

@section('header')
<link rel="stylesheet" href="{{ url('assets/css/about.css') }}?v={{ time() }}">
@endsection

@section('content')
<!-- ==========================================================================
     1. ABOUT HERO SECTION
     ========================================================================== -->
<section class="about-hero-redesign">
    <div class="about-hero-inner">
        <div class="about-pill-tag">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
            <span>About Ella Beauty</span>
        </div>

        <h1 class="about-hero-title">
            More Than Just <span>Braids</span> 🤎
        </h1>

        <p class="about-hero-subtitle">
            Ella Beauty was created from a love for braiding, creativity and helping women and girls feel confident in their hair.
        </p>


    </div>
</section>

<!-- ==========================================================================
     2. STORY & PHILOSOPHY SECTION
     ========================================================================== -->
<section class="about-story-section">
    <div class="container">
        <div class="story-layout-grid">

            <!-- Visual Left Column -->
            <div class="story-image-column">
                <div class="story-image-container">
                    <img src="{{ url('assets/images/hero2.jpg') }}" alt="Ella Beauty Braiding Artistry" class="story-main-photo">
                </div>
                <div class="story-floating-card">
                    <img src="{{ url('assets/images/logo.jpeg') }}" alt="Ella Beauty" class="story-card-logo">
                    <div class="story-card-info">
                        <strong>Ella Beauty</strong>
                        <span>Handcrafted with Care</span>
                    </div>
                </div>
            </div>

            <!-- Text Right Column -->
            <div class="story-text-column">
                <span class="section-tag-eyebrow">Our Philosophy & Craft</span>
                <h2 class="story-text-heading">Every Hairstyle Created With Heart & Precision</h2>
                <p class="story-text-paragraph">
                    Every hairstyle is created with attention to detail — from the parting and neatness to the finishing touches.
                </p>
                <p class="story-text-paragraph">
                    Whether you're looking for a simple protective style, a holiday look, a special occasion hairstyle or something you've had saved on your phone for weeks, the goal is simple: <strong>to make you love your hair. ✨</strong>
                </p>

                <div class="crown-callout-card">
                    <div class="crown-callout-quote">"Your hair. Your crown. Your style. 👑"</div>
                    <div class="crown-callout-author">The Ella Beauty Promise</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================================================
     3. PILLARS OF EXCELLENCE / CORE VALUES
     ========================================================================== -->
<section class="about-values-section">
    <div class="container">
        <div class="section-intro-header">
            <span class="section-badge-eyebrow">What Sets Us Apart</span>
            <h2 class="section-main-heading">The Ella Beauty <span>Difference</span></h2>
            <p class="section-main-desc">
                Dedicated standards of care, comfort, neatness, and healthy hair protection.
            </p>
        </div>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon-box">✨</div>
                <h4>Precision Parting</h4>
                <p>Clean, crisp lines and consistent sectioning that elevate every look to salon perfection.</p>
            </div>

            <div class="value-card">
                <div class="value-icon-box">🌿</div>
                <h4>Tension-Free Edges</h4>
                <p>Gentle on your scalp, protecting your edges and promoting natural hair health and growth.</p>
            </div>

            <div class="value-card">
                <div class="value-icon-box">🎨</div>
                <h4>Creative Customization</h4>
                <p>Bring in any inspiration photo or dream look; we bring it to life with bespoke craftsmanship.</p>
            </div>

            <div class="value-card">
                <div class="value-icon-box">👑</div>
                <h4>Confidence First</h4>
                <p>We ensure you leave each session feeling empowered, refreshed, and in love with your crown.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. SERVICE COVERAGE & LOCATION SPOTLIGHT
     ========================================================================== -->


<!-- ==========================================================================
     5. SIGNATURE LOOKBOOK RIBBON (SCROLLABLE & DYNAMIC FROM ADMIN)
     ========================================================================== -->
<section class="about-lookbook-section">
    <div class="lookbook-section-header">
        <div class="lookbook-header-left">
            <span class="lookbook-badge">PORTFOLIO & LOOKBOOK</span>
            <h3 class="lookbook-title">Our Recent <em>Hair Artistry</em></h3>
        </div>
        <div class="lookbook-scroll-nav">
            <button type="button" class="lookbook-nav-btn" id="lookbookPrevBtn" aria-label="Scroll Left">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>
            <button type="button" class="lookbook-nav-btn" id="lookbookNextBtn" aria-label="Scroll Right">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>
    </div>

    <div class="about-lookbook-strip" id="aboutLookbookStrip">
        @forelse($gallery as $item)
        @php
        $imgSrc = filter_var($item->image_path, FILTER_VALIDATE_URL) ? $item->image_path : (str_starts_with($item->image_path, '/') ? url($item->image_path) : asset($item->image_path));
        @endphp
        <div class="lookbook-strip-item">
            <img src="{{ $imgSrc }}" alt="{{ $item->title }}" loading="lazy" onerror="this.src='{{ asset('assets/images/braided4.avif') }}'">
            <div class="lookbook-item-overlay">
                @if($item->category)
                <span class="lookbook-item-cat">{{ $item->category }}</span>
                @endif
                <h4 class="lookbook-item-name">{{ $item->title }}</h4>
                @if($item->caption)
                <p class="lookbook-item-desc">{{ Str::limit($item->caption, 60) }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="lookbook-strip-item">
            <img src="{{ url('assets/images/braided4.avif') }}" alt="Ella Beauty Braids" loading="lazy">
            <div class="lookbook-item-overlay">
                <span class="lookbook-item-cat">Boho Braids</span>
                <h4 class="lookbook-item-name">Boho Goddess Braids</h4>
            </div>
        </div>
        <div class="lookbook-strip-item">
            <img src="{{ url('assets/images/hero1.jpg') }}" alt="Ella Beauty Protective Styles" loading="lazy">
            <div class="lookbook-item-overlay">
                <span class="lookbook-item-cat">Knotless</span>
                <h4 class="lookbook-item-name">Signature Knotless</h4>
            </div>
        </div>
        <div class="lookbook-strip-item">
            <img src="{{ url('assets/images/hero3.avif') }}" alt="Ella Beauty Kids Hair" loading="lazy">
            <div class="lookbook-item-overlay">
                <span class="lookbook-item-cat">Kids Hair</span>
                <h4 class="lookbook-item-name">Kids Gentle Styling</h4>
            </div>
        </div>
        <div class="lookbook-strip-item">
            <img src="{{ url('assets/images/hero4.jpg') }}" alt="Ella Beauty Travel Appointments" loading="lazy">
            <div class="lookbook-item-overlay">
                <span class="lookbook-item-cat">Mobile Service</span>
                <h4 class="lookbook-item-name">VIP Home Glam</h4>
            </div>
        </div>
        @endforelse
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const strip = document.getElementById('aboutLookbookStrip');
        const prevBtn = document.getElementById('lookbookPrevBtn');
        const nextBtn = document.getElementById('lookbookNextBtn');

        if (strip && prevBtn && nextBtn) {
            const scrollAmount = 340;

            prevBtn.addEventListener('click', function() {
                strip.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', function() {
                strip.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>

<!-- ==========================================================================
     6. FINAL CTA BANNER
     ========================================================================== -->
<section class="about-final-banner">
    <div class="final-banner-container">
        <h2>Your Hair. Your Crown. Your Style. 👑</h2>
        <p>
            Join the hundreds of happy clients across Luton and beyond who trust Ella Beauty for neat, protective, and radiant hair artistry.
        </p>
        <button type="button" class="btn-about-final-cta" onclick="openBookingModal()">
            <span>Book Your Appointment Today</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</section>
@endsection