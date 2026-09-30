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

@section('script')
<script>
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
@endsection