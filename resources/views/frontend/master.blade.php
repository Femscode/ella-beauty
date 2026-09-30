<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ella Beauty — Luxury Hair Salon & Booking Studio</title>
    <meta name="description" content="Experience bespoke hair artistry at Ella Beauty. Luxury knotless braids, flawless HD lace wig installations, gloss silk presses, and scalp wellness. Book your chair today.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts: Montserrat + Playfair Display (Slanted/Curly Italic) + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800&family=Playfair+Display:ital,wght@1,400;1,500;1,600;1,700;1,800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ url('assets/images/logo.jpeg') }}" type="image/jpeg">

    <!-- Master & Shared CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/master1.css') }}?v={{ time() }}">
    <style>
        /* Seamless Topnav Overlay on Hero Background */
        .header {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 1000 !important;
            background: linear-gradient(180deg, rgba(15, 10, 48, 0.72) 0%, rgba(15, 10, 48, 0.2) 75%, transparent 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            transition: all 0.35s ease !important;
        }

        .header.scrolled {
            position: fixed !important;
            background: rgba(22, 13, 74, 0.96) !important;
            backdrop-filter: blur(18px) !important;
            -webkit-backdrop-filter: blur(18px) !important;
            box-shadow: 0 4px 25px rgba(15, 10, 48, 0.35) !important;
            border-bottom: 1px solid rgba(56, 189, 248, 0.3) !important;
        }
    </style>
    @yield('header')
</head>

<body>
    <!-- Main Navigation Header (Overlays Hero Background) -->
    <header class="header" id="mainHeader">
        <nav class="nav-container">
            <div class="nav-content">
                <!-- Brand Logo -->
                <a href="/" class="brand-logo" id="brandLogo">
                    <img src="{{ url('assets/images/logo.jpeg') }}" alt="Ella Beauty" class="brand-logo-img">
                    <div class="brand-text-block">
                        <span class="brand-title">Ella <span>Beauty</span></span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <div class="nav-menu desktop">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Our Services</a>
                    <a href="{{ route('home') }}#reviews" class="nav-link">Reviews</a>
                    <a href="{{ route('home') }}#faq" class="nav-link">Salon FAQ</a>
                </div>

                <!-- Navigation Actions -->
                <div class="nav-actions">
                    <a href="{{ route('booking') }}" class="btn-book-nav" id="navBookBtn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Book Appointment</span>
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle Navigation">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div class="mobile-menu" id="mobileMenu">
                <div class="mobile-menu-content">
                    <div class="mobile-menu-header">
                        <div class="brand-logo">
                            <img src="{{ url('assets/images/logo.jpeg') }}" alt="Ella Beauty" class="brand-logo-img">
                            <div class="brand-text-block">
                                <span class="brand-title">Ella <span>Beauty</span></span>
                                <span class="brand-tagline">Luxury Hair Lounge</span>
                            </div>
                        </div>
                        <button class="mobile-menu-close" onclick="toggleMobileMenu()" aria-label="Close Menu">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mobile-menu-links">
                        <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" onclick="toggleMobileMenu()">Home <span>→</span></a>
                        <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" onclick="toggleMobileMenu()">About Us <span>→</span></a>
                        <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}" onclick="toggleMobileMenu()">Our Services <span>→</span></a>
                        <a href="{{ route('booking') }}" class="mobile-nav-link {{ request()->routeIs('booking*') ? 'active' : '' }}" onclick="toggleMobileMenu()">Book & Policies <span>→</span></a>
                        <a href="{{ route('home') }}#experience" class="mobile-nav-link" onclick="toggleMobileMenu()">The Experience <span>→</span></a>
                        <a href="{{ route('home') }}#lookbook" class="mobile-nav-link" onclick="toggleMobileMenu()">Lookbook <span>→</span></a>
                        <a href="{{ route('home') }}#reviews" class="mobile-nav-link" onclick="toggleMobileMenu()">Client Reviews <span>→</span></a>
                        <a href="{{ route('home') }}#faq" class="mobile-nav-link" onclick="toggleMobileMenu()">Salon FAQ <span>→</span></a>
                        <a href="{{ route('booking') }}" class="mobile-contact-btn" onclick="toggleMobileMenu();">
                            ✨ Book An Appointment Now
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- ======================================================================
         INTERACTIVE BOOKING MODAL
         ====================================================================== -->
    <div class="booking-modal-overlay" id="bookingModalOverlay" onclick="handleOverlayClick(event)">
        <div class="booking-modal-card">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-header-text">
                    <h3>Reserve Your Chair</h3>
                    <p>Select your bespoke hair service, preferred artist, and date</p>
                </div>
                <button class="modal-close-btn" onclick="closeBookingModal()" aria-label="Close modal">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Modal Form View -->
            <form id="appointmentBookingForm" onsubmit="handleBookingSubmit(event)">
                <div class="modal-body" id="bookingFormBody">
                    <!-- Step 1 & Step 2: Service & Size/Length -->
                    <div class="booking-form-grid two-col">
                        <div class="form-group">
                            <label class="form-label" for="bookService">1. Select Style / Service</label>
                            <select id="bookService" class="form-select" required>
                                <option value="Braids (Knotless, Box, Boho)">Braids (Knotless, Box, Boho)</option>
                                <option value="Twists (Passion, Senegalese, Marley)">Twists (Passion, Senegalese, Marley)</option>
                                <option value="Kids' Hair Protective Styles">Kids' Hair Protective Styles</option>
                                <option value="Signature Protective Styles">Signature Protective Styles</option>
                                <option value="Mobile Braiding / Home Service">Mobile Braiding / Home Service</option>
                                <option value="Travel Appointments">Travel Appointments</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="bookSizeLength">2. Choose Size & Length</label>
                            <select id="bookSizeLength" class="form-select" required>
                                <option value="Medium — Mid Back">Medium — Mid Back</option>
                                <option value="Small — Mid Back">Small — Mid Back</option>
                                <option value="Medium — Waist Length">Medium — Waist Length</option>
                                <option value="Small — Waist Length">Small — Waist Length</option>
                                <option value="Large / Jumbo — Mid Back">Large / Jumbo — Mid Back</option>
                                <option value="Waist / Butt Length">Waist / Butt Length</option>
                                <option value="Custom / Kids Standard">Custom / Kids Standard</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 3 & Step 4: Location & Date -->
                    <div class="booking-form-grid two-col">
                        <div class="form-group">
                            <label class="form-label" for="bookLocation">3. Service Location</label>
                            <select id="bookLocation" class="form-select" required>
                                <option value="Salon Studio (Luton)">Salon Studio (Luton)</option>
                                <option value="Mobile Braiding / Home Service (Luton & Local)">Mobile Braiding / Home Service (Luton & Local)</option>
                                <option value="Travel Appointment (Selected Regions)">Travel Appointment (Selected Regions)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="bookDate">4. Preferred Date</label>
                            <input type="date" id="bookDate" class="form-input" required>
                        </div>
                    </div>

                    <!-- Time Slots -->
                    <div class="form-group">
                        <label class="form-label">Select Preferred Time Slot</label>
                        <div class="time-slots-container">
                            <div class="time-chip selected" onclick="selectTimeChip(this, '09:30 AM')">09:30 AM</div>
                            <div class="time-chip" onclick="selectTimeChip(this, '11:45 AM')">11:45 AM</div>
                            <div class="time-chip" onclick="selectTimeChip(this, '02:00 PM')">02:00 PM</div>
                            <div class="time-chip" onclick="selectTimeChip(this, '04:30 PM')">04:30 PM</div>
                            <div class="time-chip" onclick="selectTimeChip(this, '06:00 PM')">06:00 PM</div>
                        </div>
                        <input type="hidden" id="selectedTimeSlot" value="09:30 AM">
                    </div>

                    <!-- Client Details -->
                    <div class="booking-form-grid two-col">
                        <div class="form-group">
                            <label class="form-label" for="clientName">Your Full Name</label>
                            <input type="text" id="clientName" class="form-input" placeholder="e.g. Vanessa Johnson" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="clientPhone">Phone / WhatsApp Number</label>
                            <input type="tel" id="clientPhone" class="form-input" placeholder="e.g. +44 7123 456789" required>
                        </div>
                    </div>

                    <div class="booking-form-grid two-col">
                        <div class="form-group">
                            <label class="form-label" for="gelPreference">Styling Finish (Gel Preference)</label>
                            <select id="gelPreference" class="form-select">
                                <option value="With Hair Gel (Laid & Defined Finish)">With Hair Gel (Laid & Defined Finish)</option>
                                <option value="Without Hair Gel (No Gel / Soft Natural)">Without Hair Gel (No Gel / Soft Natural)</option>
                                <option value="Undecided / Discuss at Appointment">Undecided / Discuss at Appointment</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="clientNotes">Hair Notes / Address (for Mobile & Travel)</label>
                            <textarea id="clientNotes" class="form-textarea" rows="2" placeholder="Provide postcode if mobile/travel, or mention hair notes..."></textarea>
                        </div>
                    </div>

                    <!-- Step 5: Deposit Notice & Submit -->
                    <div class="modal-footer">
                        <div class="modal-notice">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <span><strong>Deposit Notice:</strong> A 30% deposit is required to secure your appointment.</span>
                        </div>
                        <button type="submit" class="btn-submit-booking" id="btnSubmitBooking">
                            <span>Confirm & Secure Slot</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Booking Success View -->
                <div class="booking-success-view" id="bookingSuccessView">
                    <div class="success-icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3 style="font-family: var(--font-serif); font-size: 2rem; color: var(--color-primary); margin-bottom: 0.5rem;">Appointment Reserved!</h3>
                    <p style="color: var(--color-text-muted); max-width: 440px;">Thank you, <strong id="confirmedClientName">client</strong>! Your chair has been reserved. A confirmation SMS and WhatsApp reminder have been dispatched.</p>

                    <div class="booking-receipt-card">
                        <div class="receipt-row">
                            <span style="color: var(--color-secondary); font-weight: 600;">Style / Service</span>
                            <span id="confirmedService" style="font-weight: 700; color: var(--color-primary);"></span>
                        </div>
                        <div class="receipt-row">
                            <span style="color: var(--color-secondary); font-weight: 600;">Size & Length</span>
                            <span id="confirmedSizeLength" style="font-weight: 700; color: var(--color-primary);"></span>
                        </div>
                        <div class="receipt-row">
                            <span style="color: var(--color-secondary); font-weight: 600;">Location</span>
                            <span id="confirmedLocation" style="font-weight: 700; color: var(--color-accent-dark);"></span>
                        </div>
                        <div class="receipt-row">
                            <span style="color: var(--color-secondary); font-weight: 600;">Date & Time</span>
                            <span id="confirmedDateTime" style="font-weight: 700; color: var(--color-primary);"></span>
                        </div>
                        <div class="receipt-row" style="background: rgba(212, 175, 55, 0.1); margin: 0.5rem -1rem -0.5rem; padding: 0.6rem 1rem; border-radius: 0 0 var(--radius-sm) var(--radius-sm);">
                            <span style="color: var(--color-primary); font-weight: 700;">Deposit Status</span>
                            <span style="font-weight: 800; color: #B38F27;">£30 Due to Secure</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                        <button type="button" class="btn-primary-gold" onclick="closeBookingModal()">Done</button>
                        <a id="whatsappConfirmLink" href="https://wa.me/" target="_blank" class="btn-secondary-outline" style="border-color: #25D366; color: #128C7E;">
                            <span>Confirm via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification Element -->
    <div id="ellaToast" class="ella-toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <span id="ellaToastText">Notification text</span>
    </div>

    <!-- ======================================================================
         LUXURY FOOTER
         ====================================================================== -->
    <footer class="footer-section">
        <div class="footer-container">
            <div class="footer-main">
                <!-- Column 1: Brand & Identity -->
                <div class="footer-brand">
                    <div class="brand-logo">
                        <img src="{{ url('assets/images/logo.jpeg') }}" alt="Ella Beauty" class="brand-logo-img">
                        <div class="brand-text-block">
                            <span class="brand-title">ELLA BEAUTY ✨</span>
                            <span class="brand-tagline">Beautifully braided. Confidently you.</span>
                        </div>
                    </div>
                    <div class="footer-queen-badge">
                        <span class="queen-crown">👑</span>
                        <strong>Hair for Queens</strong>
                    </div>
                    <p class="footer-specialties">
                        Braids • Protective Styles • Kids' Hair
                    </p>
                    <div class="footer-social">
                        <a href="https://instagram.com/_ella_beauty" target="_blank" class="social-link" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="https://tiktok.com/@__ella_beauty" target="_blank" class="social-link" aria-label="TikTok">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.97v7.65c0 1.83-.52 3.66-1.57 5.16-1.63 2.37-4.41 3.86-7.34 3.79-3.21-.07-6.07-2.11-7.07-5.15-.99-3.05-.09-6.49 2.27-8.6 1.74-1.56 4.1-2.34 6.45-2.13v4.18c-1.15-.17-2.36.14-3.25.87-.9.74-1.39 1.88-1.32 3.04.07 1.16.71 2.22 1.72 2.79 1.01.57 2.28.61 3.32.1 1.05-.51 1.72-1.58 1.72-2.75V.02h.2z" />
                            </svg>
                        </a>
                        <a href="https://wa.me/447350166691" target="_blank" class="social-link" aria-label="WhatsApp">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="footer-links">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-menu">
                        <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                        <li><a href="{{ route('about') }}" class="footer-link">About Ella Beauty</a></li>
                        <li><a href="{{ route('services') }}" class="footer-link">Hairstyles & Pricing</a></li>
                        <li><a href="{{ route('booking') }}" class="footer-link">Book Appointment</a></li>
                        <li><a href="{{ route('portfolio') }}" class="footer-link">Lookbook Portfolio</a></li>
                        <li><a href="{{ route('contact-us') }}" class="footer-link">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 3: Service & Locations -->
                <div class="footer-links">
                    <h4 class="footer-heading">Service & Travel</h4>
                    <ul class="footer-menu footer-service-locations">
                        <li>
                            <span class="loc-icon">📍</span>
                            <span><strong>Location:</strong> Serving Luton & surrounding areas</span>
                        </li>
                        <li>
                            <span class="loc-icon">🏠</span>
                            <span><strong>Mobile:</strong> Mobile Braiding / Home Service Available</span>
                        </li>
                        <li>
                            <span class="loc-icon">🚗</span>
                            <span><strong>Travel:</strong> Travel Available for selected locations</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div class="footer-contact">
                    <h4 class="footer-heading">Get in Touch</h4>
                    <div class="footer-contact-list">
                        <div class="contact-item">
                            <span class="contact-emoji">📩</span>
                            <span>
                                <strong>Social Media</strong>
                                Instagram: <a href="https://instagram.com/_ella_beauty" target="_blank" class="footer-inline-link">@_ella_beauty</a><br>
                                TikTok: <a href="https://tiktok.com/@__ella_beauty" target="_blank" class="footer-inline-link">__ella_beauty</a>
                            </span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-emoji">💬</span>
                            <span>
                                <strong>WhatsApp</strong>
                                <a href="https://wa.me/447350166691" target="_blank" class="footer-inline-link">wa.me/+447350166691</a>
                            </span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-emoji">✉️</span>
                            <span>
                                <strong>Email</strong>
                                <a href="mailto:Prettytoll@gmail.com" class="footer-inline-link">Prettytoll@gmail.com</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p class="footer-copyright">
                        © 2026 Ella Beauty. All rights reserved.
                    </p>
                    <div class="footer-bottom-links">
                        <a href="{{ route('booking') }}#booking-policies" class="footer-link">Booking Policies</a>
                        <a href="{{ route('booking') }}" class="footer-link-accent">Secure Your Date (30% Deposit)</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global JavaScript for Ella Beauty Experience -->
    <script>
        // Set today's date as min for booking
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('bookDate');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.min = today;
                dateInput.value = today;
            }

            // Scroll effect for header
            window.addEventListener('scroll', () => {
                const header = document.getElementById('mainHeader');
                if (window.scrollY > 40) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });

        // Booking Handler (Directs to Dedicated Booking Page)
        function openBookingModal(serviceName) {
            let url = "{{ route('booking') }}";
            if (serviceName) {
                url += "?service=" + encodeURIComponent(serviceName);
            }
            window.location.href = url;
        }

        function closeBookingModal() {
            const modal = document.getElementById('bookingModalOverlay');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function handleOverlayClick(event) {
            if (event.target.id === 'bookingModalOverlay') {
                closeBookingModal();
            }
        }

        function selectTimeChip(element, timeString) {
            document.querySelectorAll('.time-chip').forEach(chip => chip.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('selectedTimeSlot').value = timeString;
        }

        function handleBookingSubmit(event) {
            event.preventDefault();
            const service = document.getElementById('bookService').value;
            const sizeLength = document.getElementById('bookSizeLength').value;
            const location = document.getElementById('bookLocation').value;
            const date = document.getElementById('bookDate').value;
            const time = document.getElementById('selectedTimeSlot').value;
            const clientName = document.getElementById('clientName').value;
            const phone = document.getElementById('clientPhone').value;
            const notes = document.getElementById('clientNotes').value;

            // Update confirmation details
            document.getElementById('confirmedClientName').innerText = clientName;
            document.getElementById('confirmedService').innerText = service;
            document.getElementById('confirmedSizeLength').innerText = sizeLength;
            document.getElementById('confirmedLocation').innerText = location;
            document.getElementById('confirmedDateTime').innerText = `${date} at ${time}`;

            // Prepare WhatsApp direct link
            const waText = encodeURIComponent(`Hello Ella Beauty! I'd like to book an appointment:\n- Style: ${service}\n- Size & Length: ${sizeLength}\n- Location: ${location}\n- Date & Time: ${date} at ${time}\n- Client Name: ${clientName}\n- Phone: ${phone}${notes ? `\n- Notes/Address: ${notes}` : ''}\n\nPlease share the payment details to complete my £30 deposit.`);
            const waLink = document.getElementById('whatsappConfirmLink');
            if (waLink) {
                waLink.href = `https://wa.me/447123456789?text=${waText}`;
            }

            // Switch to confirmation view
            document.getElementById('bookingFormBody').style.display = 'none';
            document.getElementById('bookingSuccessView').classList.add('active');

            showToast("✨ Appointment Request Submitted! Complete your deposit to secure your chair.");
        }

        // Mobile Menu Drawer Handler
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
            if (menu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // FAQ Accordion Handler
        function toggleFAQ(element) {
            const currentItem = element.parentElement;
            const isActive = currentItem.classList.contains('active');

            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            if (!isActive) {
                currentItem.classList.add('active');
            }
        }

        // Toast Helper
        function showToast(message) {
            const toast = document.getElementById('ellaToast');
            const text = document.getElementById('ellaToastText');
            if (toast && text) {
                text.innerText = message;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 4000);
            }
        }
    </script>

    @yield('script')
</body>

</html>