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

        <!-- 4 Primary Hair Style Categories -->
        <div class="services-editorial-grid">
            
            <!-- 1. BRAIDS -->
            <div class="service-luxury-card">
                <div class="service-card-top-image">
                    <span class="service-card-tag">✨ Signature Craft</span>
                    <img src="{{ url('assets/images/braided4.avif') }}" alt="Braids by Ella Beauty" loading="lazy">
                </div>
                <div class="service-card-content">
                    <div class="service-card-header-row">
                        <h3 class="service-title-primary">BRAIDS</h3>
                        <div class="service-icon-indicator" title="Braiding Excellence">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                    </div>
                    <p class="service-card-description">
                        Knotless braids, box braids, boho braids, Miracle Knots and other braided protective styles.
                    </p>
                    <div class="service-style-pills">
                        <span class="style-pill">Knotless Braids</span>
                        <span class="style-pill">Box Braids</span>
                        <span class="style-pill">Boho Braids</span>
                        <span class="style-pill">Miracle Knots</span>
                        <span class="style-pill">Protective Styles</span>
                    </div>
                    <div class="service-card-footer">
                        <button type="button" class="btn-book-service-card" onclick="openBookingModal('Braids')">
                            <span>Book Braids</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. TWISTS -->
            <div class="service-luxury-card">
                <div class="service-card-top-image">
                    <span class="service-card-tag">💫 Textured & Neat</span>
                    <img src="{{ url('assets/images/hero2.jpg') }}" alt="Twists by Ella Beauty" loading="lazy">
                </div>
                <div class="service-card-content">
                    <div class="service-card-header-row">
                        <h3 class="service-title-primary">TWISTS</h3>
                        <div class="service-icon-indicator" title="Twist Artistry">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="service-card-description">
                        From simple twists to detailed and intricate twist styles.
                    </p>
                    <div class="service-style-pills">
                        <span class="style-pill">Simple Twists</span>
                        <span class="style-pill">Intricate Patterns</span>
                        <span class="style-pill">Passion Twists</span>
                        <span class="style-pill">Senegalese Twists</span>
                        <span class="style-pill">Marley Twists</span>
                    </div>
                    <div class="service-card-footer">
                        <button type="button" class="btn-book-service-card" onclick="openBookingModal('Twists')">
                            <span>Book Twists</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3. KIDS' HAIR -->
            <div class="service-luxury-card">
                <div class="service-card-top-image">
                    <span class="service-card-tag">🌸 Gentle & Gentle-Care</span>
                    <img src="{{ url('assets/images/hero3.avif') }}" alt="Kids Hair by Ella Beauty" loading="lazy">
                </div>
                <div class="service-card-content">
                    <div class="service-card-header-row">
                        <h3 class="service-title-primary">KIDS' HAIR</h3>
                        <div class="service-icon-indicator" title="Kids Care">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="4"></circle>
                                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                            </svg>
                        </div>
                    </div>
                    <p class="service-card-description">
                        Beautiful, age-appropriate protective styles for children.
                    </p>
                    <div class="service-style-pills">
                        <span class="style-pill">Age-Appropriate</span>
                        <span class="style-pill">Tension-Free Scalp</span>
                        <span class="style-pill">School Ready</span>
                        <span class="style-pill">Beads & Accessories</span>
                        <span class="style-pill">Gentle Parting</span>
                    </div>
                    <div class="service-card-footer">
                        <button type="button" class="btn-book-service-card" onclick="openBookingModal('Kids Hair')">
                            <span>Book Kids' Hair</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. PROTECTIVE STYLES -->
            <div class="service-luxury-card">
                <div class="service-card-top-image">
                    <span class="service-card-tag">🌿 Healthy Growth</span>
                    <img src="{{ url('assets/images/hero1.jpg') }}" alt="Protective Styles by Ella Beauty" loading="lazy">
                </div>
                <div class="service-card-content">
                    <div class="service-card-header-row">
                        <h3 class="service-title-primary">PROTECTIVE STYLES</h3>
                        <div class="service-icon-indicator" title="Hair Health">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="service-card-description">
                        Styles designed to look beautiful while helping you maintain and protect your natural hair.
                    </p>
                    <div class="service-style-pills">
                        <span class="style-pill">Natural Hair Protection</span>
                        <span class="style-pill">Length Retention</span>
                        <span class="style-pill">Scalp Wellness</span>
                        <span class="style-pill">Low Maintenance</span>
                        <span class="style-pill">Edge Preservation</span>
                    </div>
                    <div class="service-card-footer">
                        <button type="button" class="btn-book-service-card" onclick="openBookingModal('Protective Styles')">
                            <span>Book Protective Styles</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Dedicated Special Service Spotlights: Mobile & Travel Appointments -->
        <div class="services-special-section">
            <div class="special-services-grid">
                
                <!-- 5. MOBILE BRAIDING / HOME SERVICE -->
                <div class="special-service-card">
                    <div class="special-card-glow"></div>
                    <div>
                        <div class="special-card-badge">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>At Your Doorstep</span>
                        </div>
                        <h3 class="special-card-title">MOBILE BRAIDING / HOME SERVICE</h3>
                        <p class="special-card-text">
                            Don't want to leave home? Ella Beauty can bring the braiding appointment to you.
                        </p>
                        <ul class="special-card-perks">
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>Relax in the comfort and convenience of your home</span>
                            </li>
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>Available in Luton and selected surrounding areas</span>
                            </li>
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>All braiding tools and premium equipment brought to you</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <button type="button" class="btn-special-book" onclick="openBookingModal('Mobile Braiding / Home Service')">
                            <span>Book Home Service</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- 6. TRAVEL APPOINTMENTS -->
                <div class="special-service-card">
                    <div class="special-card-glow"></div>
                    <div>
                        <div class="special-card-badge">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>Beyond Luton</span>
                        </div>
                        <h3 class="special-card-title">TRAVEL APPOINTMENTS</h3>
                        <p class="special-card-text">
                            Travel appointments are available for selected locations. Additional travel charges may apply depending on distance.
                        </p>
                        <ul class="special-card-perks">
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>Flexible scheduling for special events, bridal looks & occasions</span>
                            </li>
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>Custom distance-based travel arrangement</span>
                            </li>
                            <li>
                                <div class="perk-check-icon">✓</div>
                                <span>Direct coordination via WhatsApp or Phone</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <button type="button" class="btn-special-book" onclick="openBookingModal('Travel Appointments')">
                            <span>Book Travel Appointment</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

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
