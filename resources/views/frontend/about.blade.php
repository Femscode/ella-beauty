@extends('frontend.master')

@section('header')
<link rel="stylesheet" href="{{ url('assets/css/about.css') }}?v={{ time() }}">
@endsection

@section('content')
<!-- ==========================================================================
     1. ABOUT HERO SECTION
     ========================================================================== -->
<section class="about-hero-redesign">
    <div class="about-hero-orb-secondary" aria-hidden="true"></div>
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
            Ella Beauty was created from a pure passion for braiding, creativity, and helping every client feel confident, empowered, and in love with their crown.
        </p>

        <!-- Hero Badges Grid -->
        <div class="about-hero-badges-grid">
            <div class="about-badge-item">
                <span class="about-badge-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                        <line x1="16" y1="8" x2="2" y2="22"></line>
                        <line x1="17.5" y1="15" x2="9" y2="15"></line>
                    </svg>
                </span>
                <span class="about-badge-label">Tension-Free Grip</span>
            </div>
            <div class="about-badge-item">
                <span class="about-badge-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </span>
                <span class="about-badge-label">Luton &amp; Mobile Visits</span>
            </div>
            <div class="about-badge-item">
                <span class="about-badge-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="6" cy="6" r="3"></circle>
                        <circle cx="6" cy="18" r="3"></circle>
                        <line x1="20" y1="4" x2="8.12" y2="15.88"></line>
                        <line x1="14.47" y1="14.48" x2="20" y2="20"></line>
                        <line x1="8.12" y1="8.12" x2="12" y2="12"></line>
                    </svg>
                </span>
                <span class="about-badge-label">Bespoke Styling</span>
            </div>
            <div class="about-badge-item">
                <span class="about-badge-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </span>
                <span class="about-badge-label">Edge Health Care</span>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     2. STORY & PHILOSOPHY SECTION
     ========================================================================== -->
<section class="about-story-section">
    <div class="container">
        <div class="story-layout-grid">

            <!-- Visual Left Column -->
            <div class="story-image-column" data-reveal>
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
            <div class="story-text-column" data-reveal data-reveal-delay="200">
                <span class="section-tag-eyebrow">Our Philosophy &amp; Craft</span>
                <h2 class="story-text-heading">Every Hairstyle Created With <span>Heart &amp; Precision</span></h2>
                <p class="story-text-paragraph">
                    Every hairstyle is created with immaculate attention to detail — from clean, symmetrical parting and gentle scalp grip to flawless finishing touches.
                </p>
                <p class="story-text-paragraph">
                    Whether you're looking for a simple protective style, a holiday look, a special occasion hairstyle, or something you've had saved on your phone for weeks, our goal is simple: <strong>to make you love your crown. ✨</strong>
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
        <div class="section-intro-header" data-reveal>
            <span class="section-badge-eyebrow">What Sets Us Apart</span>
            <h2 class="section-main-heading">The Ella Beauty <span>Difference</span></h2>
            <p class="section-main-desc">
                Dedicated standards of comfort, neatness, tension-free edge protection, and healthy hair care.
            </p>
        </div>

        <div class="values-grid">
            <div class="value-card" data-reveal data-reveal-delay="100">
                <div class="value-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="22" y1="12" x2="18" y2="12"></line>
                        <line x1="6" y1="12" x2="2" y2="12"></line>
                        <line x1="12" y1="6" x2="12" y2="2"></line>
                        <line x1="12" y1="22" x2="12" y2="18"></line>
                    </svg>
                </div>
                <h4>Precision Parting</h4>
                <p>Clean, crisp lines and consistent sectioning that elevate every look to salon perfection.</p>
            </div>

            <div class="value-card" data-reveal data-reveal-delay="200">
                <div class="value-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h4>Tension-Free Edges</h4>
                <p>Gentle on your scalp, protecting your edges and promoting natural hair health and growth.</p>
            </div>

            <div class="value-card" data-reveal data-reveal-delay="300">
                <div class="value-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="13.5" cy="6.5" r=".5" fill="currentColor"></circle>
                        <circle cx="17.5" cy="10.5" r=".5" fill="currentColor"></circle>
                        <circle cx="8.5" cy="7.5" r=".5" fill="currentColor"></circle>
                        <circle cx="6.5" cy="12.5" r=".5" fill="currentColor"></circle>
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2z"></path>
                    </svg>
                </div>
                <h4>Creative Customization</h4>
                <p>Bring in any inspiration photo or dream look; we bring it to life with bespoke craftsmanship.</p>
            </div>

            <div class="value-card" data-reveal data-reveal-delay="400">
                <div class="value-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"></path>
                    </svg>
                </div>
                <h4>Confidence First</h4>
                <p>We ensure you leave each session feeling empowered, refreshed, and in love with your crown.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. SIGNATURE LOOKBOOK RIBBON (SCROLLABLE & DYNAMIC FROM ADMIN)
     ========================================================================== -->
<section class="about-lookbook-section">
    <div class="lookbook-section-header" data-reveal>
        <div class="lookbook-header-left">
            <span class="lookbook-badge">PORTFOLIO &amp; LOOKBOOK</span>
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

    @php
    $galleryList = $gallery->isNotEmpty() ? $gallery->map(function($item) {
        return [
            'id' => $item->id,
            'title' => $item->title ?? 'Ella Beauty Style',
            'category' => $item->category ?? 'Hair Artistry',
            'caption' => $item->caption ?? '',
            'image_url' => $item->image_url,
        ];
    }) : collect([
        [
            'id' => 1,
            'title' => 'Boho Goddess Braids',
            'category' => 'Boho Braids',
            'caption' => 'Lightweight, neat parting and bouncy curly ends.',
            'image_url' => url('assets/images/braided4.avif'),
        ],
        [
            'id' => 2,
            'title' => 'Signature Knotless',
            'category' => 'Knotless',
            'caption' => 'Tension-free, scalp-gentle protective styling.',
            'image_url' => url('assets/images/hero1.jpg'),
        ],
        [
            'id' => 3,
            'title' => 'Kids Gentle Styling',
            'category' => "Kids' Hair",
            'caption' => 'Age-appropriate, patient and gentle hair care.',
            'image_url' => url('assets/images/hero3.avif'),
        ],
        [
            'id' => 4,
            'title' => 'VIP Home Glam',
            'category' => 'Mobile Service',
            'caption' => 'Full salon-quality appointment at your home doorstep.',
            'image_url' => url('assets/images/hero4.jpg'),
        ],
    ]);
    @endphp

    <div class="about-lookbook-strip" id="aboutLookbookStrip">
        @foreach($galleryList as $index => $item)
        <div class="lookbook-strip-item" onclick="openAboutLightbox({{ $index }})" title="Click to enlarge & preview photo">
            <div class="lookbook-zoom-badge" title="Preview image">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    <line x1="11" y1="8" x2="11" y2="14"></line>
                    <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
            </div>
            <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}" loading="lazy" onerror="this.src='{{ asset('assets/images/braided4.avif') }}'">
            <div class="lookbook-item-overlay">
                @if(!empty($item['category']))
                <span class="lookbook-item-cat">{{ $item['category'] }}</span>
                @endif
                <h4 class="lookbook-item-name">{{ $item['title'] }}</h4>
                @if(!empty($item['caption']))
                <p class="lookbook-item-desc">{{ Str::limit($item['caption'], 60) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ==========================================================================
     LIGHTBOX PREVIEW MODAL FOR ABOUT US LOOKBOOK
     ========================================================================== -->
<div id="aboutLightboxModal" class="about-lightbox-overlay" style="display: none;" onclick="closeAboutLightbox(event)">
    <div class="about-lightbox-container" onclick="event.stopPropagation()">
        <button type="button" class="btn-about-lightbox-close" onclick="closeAboutLightbox()" aria-label="Close image preview">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        
        <div class="about-lightbox-body">
            <button type="button" class="btn-about-lightbox-nav prev" id="aboutLightboxPrev" onclick="navigateAboutLightbox(-1)" aria-label="Previous image">
                ‹
            </button>
            
            <div class="about-lightbox-stage">
                <img id="aboutLightboxImg" src="" alt="Ella Beauty Gallery Artwork" class="about-lightbox-img">
                <div class="about-lightbox-caption-bar">
                    <div class="about-lightbox-caption-left">
                        <span class="about-lightbox-cat-tag" id="aboutLightboxCat">Portfolio Look</span>
                        <h4 class="about-lightbox-title" id="aboutLightboxTitle">Hairstyle Showcase</h4>
                        <p class="about-lightbox-caption-desc" id="aboutLightboxDesc" style="display: none;"></p>
                    </div>
                    <div class="about-lightbox-counter" id="aboutLightboxCounter">1 / 1</div>
                </div>
            </div>
            
            <button type="button" class="btn-about-lightbox-nav next" id="aboutLightboxNext" onclick="navigateAboutLightbox(1)" aria-label="Next image">
                ›
            </button>
        </div>
    </div>
</div>

<!-- ==========================================================================
     5. FINAL CTA BANNER
     ========================================================================== -->
<section class="about-final-banner">
    <div class="final-banner-container" data-reveal>
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

@section('script')
<script>
    // Scroll reveal
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

    // Gallery Lookbook Data for Lightbox
    const aboutGalleryData = @json($galleryList->values());
    let currentAboutIndex = 0;

    function openAboutLightbox(index) {
        if (!aboutGalleryData || aboutGalleryData.length === 0) return;
        currentAboutIndex = Math.max(0, Math.min(index, aboutGalleryData.length - 1));
        renderAboutLightboxItem();
        
        const modal = document.getElementById('aboutLightboxModal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function renderAboutLightboxItem() {
        const item = aboutGalleryData[currentAboutIndex];
        if (!item) return;

        const img = document.getElementById('aboutLightboxImg');
        const cat = document.getElementById('aboutLightboxCat');
        const title = document.getElementById('aboutLightboxTitle');
        const desc = document.getElementById('aboutLightboxDesc');
        const counter = document.getElementById('aboutLightboxCounter');
        const prevBtn = document.getElementById('aboutLightboxPrev');
        const nextBtn = document.getElementById('aboutLightboxNext');

        if (img) {
            img.style.opacity = '0.3';
            img.src = item.image_url;
            img.onload = () => { img.style.opacity = '1'; };
        }

        if (cat) cat.textContent = item.category || 'Lookbook Inspiration';
        if (title) title.textContent = item.title || 'Hairstyle Showcase';
        
        if (desc) {
            if (item.caption && item.caption.trim() !== '') {
                desc.textContent = item.caption;
                desc.style.display = 'block';
            } else {
                desc.style.display = 'none';
            }
        }

        if (counter) {
            counter.textContent = `${currentAboutIndex + 1} / ${aboutGalleryData.length}`;
        }

        if (prevBtn) prevBtn.style.visibility = (aboutGalleryData.length > 1) ? 'visible' : 'hidden';
        if (nextBtn) nextBtn.style.visibility = (aboutGalleryData.length > 1) ? 'visible' : 'hidden';
    }

    function navigateAboutLightbox(direction) {
        if (!aboutGalleryData || aboutGalleryData.length <= 1) return;
        currentAboutIndex += direction;
        if (currentAboutIndex < 0) {
            currentAboutIndex = aboutGalleryData.length - 1;
        } else if (currentAboutIndex >= aboutGalleryData.length) {
            currentAboutIndex = 0;
        }
        renderAboutLightboxItem();
    }

    function closeAboutLightbox(e) {
        if (e && e.target !== e.currentTarget && !e.target.closest('.btn-about-lightbox-close')) return;
        const modal = document.getElementById('aboutLightboxModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('aboutLightboxModal');
        if (!modal || modal.style.display === 'none') return;

        if (e.key === 'Escape') {
            closeAboutLightbox();
        } else if (e.key === 'ArrowLeft') {
            navigateAboutLightbox(-1);
        } else if (e.key === 'ArrowRight') {
            navigateAboutLightbox(1);
        }
    });

    // Horizontal lookbook ribbon scroll buttons
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
@endsection