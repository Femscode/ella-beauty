@extends('frontend.master')

@section('header')
<link rel="stylesheet" href="{{ url('assets/css/booking1.css') }}?v={{ time() }}">
@endsection

@section('content')
<!-- ==========================================================================
     1. HERO SECTION - BOOKING INFO & POLICIES
     ========================================================================== -->
<section class="booking-hero-section">
    <div class="booking-hero-inner">
        <div class="booking-pill-badge">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <span>Ella Beauty Scheduling & Menu</span>
        </div>

        <h1 class="booking-hero-title">
            Booking & <span>Pricing Menu</span> 🤎
        </h1>

        <p class="booking-hero-subtitle">
            Everything you need to know before securing your Ella Beauty appointment. Choose your style, view exact pricing, 30% deposit calculation, and reserve your chair.
        </p>

        <div class="booking-hero-actions">
            <a href="#appointmentForm" class="btn-hero-book-now">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span>Book Appointment</span>
            </a>
            <a href="#pricingMenu" class="btn-hero-policy-link">
                <span>Explore Full Price List</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="19 12 12 19 5 12"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     2. MAIN BOOKING SECTION (FORM + CHECKLIST ASYMMETRIC LAYOUT)
     ========================================================================== -->
<section class="booking-main-section" id="appointmentForm">
    <div class="container">
        <div class="booking-layout-grid">
            
            <!-- Left Side: Interactive Appointment Form with Live Price Calculation -->
            <div class="booking-form-card" id="formWrapper">
                <div class="booking-form-header">
                    <h2>Reserve Your <span>Appointment</span></h2>
                    <p>Select your desired style to view exact duration, total cost, and your 30% deposit.</p>
                </div>

                <form id="dedicatedBookingForm" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden fields for calculated totals and selection metadata -->
                    <input type="hidden" name="service_id" id="hiddenServiceId" value="">
                    <input type="hidden" name="service_name" id="hiddenServiceName" value="">
                    <input type="hidden" name="total_price" id="hiddenTotalPrice" value="0">
                    <input type="hidden" name="appointment_time" id="selectedDedicatedTime" value="09:30 AM">
                    
                    <!-- 1. Hairstyle Selection -->
                    <div class="booking-field-group">
                        <label class="booking-input-label" for="bookHairstyle">1. Select Hairstyle & Length *</label>
                        <select id="bookHairstyle" class="booking-select-control" onchange="updatePriceCalculation()" required>
                            <option value="" disabled selected>-- Select a Style from the Menu --</option>
                            
                            @if(isset($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                    @php
                                        $catGalleryImages = $category->galleryImages->take(3)->map(function($img) {
                                            return $img->image_url;
                                        })->values();
                                    @endphp
                                    <optgroup label="{{ strtoupper($category->name) }}">
                                        @foreach($category->activeServices as $service)
                                            @php
                                                $serviceImages = $catGalleryImages;
                                                if ($serviceImages->isEmpty() && $service->image) {
                                                    $serviceImages = collect([filter_var($service->image, FILTER_VALIDATE_URL) ? $service->image : (str_starts_with($service->image, '/') ? url($service->image) : asset($service->image))]);
                                                }
                                            @endphp
                                            <option value="{{ $service->id }}" 
                                                    data-id="{{ $service->id }}"
                                                    data-name="{{ $service->name }}"
                                                    data-category="{{ $category->name }}"
                                                    data-price="{{ $service->price }}" 
                                                    data-time="{{ $service->duration_hours }}" 
                                                    data-ext="{{ $service->hair_extensions_note ?? 'Braiding hair details provided upon booking.' }}"
                                                    data-images="{{ json_encode($serviceImages) }}">
                                                {{ $service->name }} (£{{ number_format($service->price, 2) }} • {{ $service->duration_hours }})
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @else
                                <optgroup label="BOHO BRAIDS">
                                    <option value="1" data-id="1" data-name="Small Boho Braids — Bob / Shoulder Length" data-category="Boho Braids" data-price="120" data-time="7 hours" data-ext="Braiding hair included. Human hair bulk bundle is not included." data-images='["{{ url("assets/images/braided4.avif") }}"]'>Small Boho Braids — Bob / Shoulder Length (£120.00 • 7 hrs)</option>
                                    <option value="2" data-id="2" data-name="Small Boho Braids — Mid-Back Length" data-category="Boho Braids" data-price="140" data-time="8 hours" data-ext="Braiding hair included." data-images='["{{ url("assets/images/hero1.jpg") }}"]'>Small Boho Braids — Mid-Back Length (£140.00 • 8 hrs)</option>
                                    <option value="3" data-id="3" data-name="Small Boho Braids — Waist Length" data-category="Boho Braids" data-price="180" data-time="10 hours" data-ext="Braiding hair included." data-images='["{{ url("assets/images/hero4.jpg") }}"]'>Small Boho Braids — Waist Length (£180.00 • 10 hrs)</option>
                                </optgroup>
                            @endif
                        </select>
                    </div>

                    <!-- Sleek, Compact & Simple Selected Service Summary Box -->
                    <div class="service-selected-compact-card" id="livePriceBox" style="display: none;">
                        <div class="selected-card-top">
                            <div class="selected-service-info">
                                <span class="selected-category-pill" id="summaryCategoryPill">Boho Braids</span>
                                <h4 class="selected-service-title" id="summaryStyleName">Style Selected</h4>
                            </div>
                            <div class="selected-duration-badge" id="summaryDuration">⏱️ 7 hours</div>
                        </div>

                        <!-- Pricing Summary Chips -->
                        <div class="selected-pricing-strip">
                            <div class="pricing-chip-item">
                                <span class="chip-label">Total Price</span>
                                <strong class="chip-value" id="summaryTotalPrice">£140.00</strong>
                            </div>
                            <div class="pricing-chip-item highlight-deposit">
                                <span class="chip-label">30% Deposit Due</span>
                                <strong class="chip-value" id="summaryDepositPrice">£42.00</strong>
                            </div>
                            <div class="pricing-chip-item">
                                <span class="chip-label">70% Balance on Day</span>
                                <strong class="chip-value" id="summaryBalancePrice">£98.00</strong>
                            </div>
                        </div>

                        <!-- Hair Extension Note -->
                        <div class="selected-note-row" id="summaryExtensionsNoteRow">
                            <span class="note-icon">💡</span>
                            <span class="note-text" id="summaryExtensionsNote">Braiding hair details provided upon booking.</span>
                        </div>

                        <!-- Attached Category Lookbook Preview (Up to 3 Images with Click-to-Preview) -->
                        <div class="selected-gallery-section" id="serviceGalleryPreview" style="display: none;">
                            <div class="gallery-preview-label-row">
                                <span class="gallery-preview-label">📸 Lookbook Inspiration (Click photo to preview)</span>
                                <span class="gallery-preview-count" id="galleryPreviewCount">3 Photos</span>
                            </div>
                            <div class="selected-gallery-thumbs" id="servicePreviewGrid">
                                <!-- Thumbnails injected via JS -->
                            </div>
                        </div>
                    </div>

                    <!-- 2. Location & Gel Preference -->
                    <div class="booking-field-row two-col">
                        <div class="booking-field-group">
                            <label class="booking-input-label" for="bookLocation">2. Service Location *</label>
                            <select id="bookLocation" name="service_location_type" class="booking-select-control" required>
                                <option value="salon_studio">Salon Studio (Luton)</option>
                                <option value="mobile_home">Mobile Braiding / Home Service (Luton & Local)</option>
                                <option value="travel">Travel Appointment (Selected Locations)</option>
                            </select>
                        </div>

                        <div class="booking-field-group">
                            <label class="booking-input-label" for="bookGelPreference">3. Gel Preference (Gel or No Gel)</label>
                            <select id="bookGelPreference" name="gel_preference" class="booking-select-control" required>
                                <option value="gel">With Hair Gel (Laid & Defined Finish)</option>
                                <option value="no_gel">Without Hair Gel (No Gel / Soft Natural)</option>
                                <option value="undecided">Undecided / Discuss at Appointment</option>
                            </select>
                        </div>
                    </div>

                    <!-- 3. Date & Time Selection -->
                    <div class="booking-field-group">
                        <label class="booking-input-label" for="bookDate">4. Preferred Appointment Date *</label>
                        <input type="date" id="bookDate" name="appointment_date" class="booking-input-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="booking-field-group">
                        <label class="booking-input-label">5. Select Preferred Time Slot *</label>
                        <div class="booking-time-grid">
                            <div class="booking-time-chip active" onclick="selectDedicatedTime(this, '09:30 AM')">09:30 AM</div>
                            <div class="booking-time-chip" onclick="selectDedicatedTime(this, '11:45 AM')">11:45 AM</div>
                            <div class="booking-time-chip" onclick="selectDedicatedTime(this, '02:00 PM')">02:00 PM</div>
                            <div class="booking-time-chip" onclick="selectDedicatedTime(this, '04:30 PM')">04:30 PM</div>
                            <div class="booking-time-chip" onclick="selectDedicatedTime(this, '06:00 PM')">06:00 PM</div>
                        </div>
                    </div>

                    <!-- 4. Client Details -->
                    <div class="booking-field-row two-col">
                        <div class="booking-field-group">
                            <label class="booking-input-label" for="clientFullName">Full Name *</label>
                            <input type="text" id="clientFullName" name="client_name" class="booking-input-control" placeholder="e.g. Vanessa Johnson" required>
                        </div>

                        <div class="booking-field-group">
                            <label class="booking-input-label" for="clientEmailAddress">Email Address *</label>
                            <input type="email" id="clientEmailAddress" name="client_email" class="booking-input-control" placeholder="e.g. vanessa@example.com" required>
                        </div>
                    </div>

                    <div class="booking-field-row two-col">
                        <div class="booking-field-group">
                            <label class="booking-input-label" for="clientPhoneNumber">Phone / WhatsApp Number *</label>
                            <input type="tel" id="clientPhoneNumber" name="client_phone" class="booking-input-control" placeholder="e.g. +44 7123 456789" required>
                        </div>

                        <div class="booking-field-group">
                            <label class="booking-input-label" for="clientCityPostcode">City / Postcode (for Travel)</label>
                            <input type="text" id="clientCityPostcode" name="city" class="booking-input-control" placeholder="e.g. Luton, LU1" value="Luton">
                        </div>
                    </div>

                    <div class="booking-field-group">
                        <label class="booking-input-label" for="clientPostcodeNotes">Full Address & Hair Notes</label>
                        <textarea id="clientPostcodeNotes" name="client_notes" class="booking-textarea-control" rows="3" placeholder="Please provide your full address for mobile/travel, or any hair details (e.g. child's age, thick hair, etc.)..."></textarea>
                    </div>

                    <!-- ==========================================================
                         5. BANK TRANSFER DETAILS & PROOF OF PAYMENT UPLOAD
                         ========================================================== -->
                    <div class="booking-deposit-payment-section">
                        <div class="deposit-payment-header">
                            <div class="deposit-header-left">
                                <span class="deposit-pill-badge">Step 5 • 30% Deposit Payment</span>
                                <h3 class="deposit-heading">Transfer Deposit & Attach Proof</h3>
                                <p class="deposit-subtext">To secure and lock in your appointment date & time, please transfer the 30% deposit to the official account below and attach your screenshot of proof.</p>
                            </div>
                            <div class="deposit-badge-box">
                                <span class="deposit-badge-label">30% Deposit Due</span>
                                <span class="deposit-badge-amount" id="depositSectionAmount">£0.00</span>
                            </div>
                        </div>

                        <!-- Bank Account Details Card -->
                        <div class="bank-details-card">
                            <div class="bank-card-top">
                                <div class="bank-brand">
                                    <div class="revolut-logo-badge">R</div>
                                    <div>
                                        <div class="bank-name-label">Revolut Bank Transfer</div>
                                        <div class="account-holder-name">Toluwalope Ajala</div>
                                    </div>
                                </div>
                                <span class="bank-verified-tag">✓ Official Account</span>
                            </div>

                            <div class="bank-details-grid">
                                <div class="bank-data-item">
                                    <div class="bank-data-label">Account Name</div>
                                    <div class="bank-data-val-row">
                                        <span class="bank-data-val" id="copyAcctName">Toluwalope Ajala</span>
                                        <button type="button" class="btn-copy-bank" onclick="copyBankDetail('Toluwalope Ajala', this)" title="Copy Account Name">Copy</button>
                                    </div>
                                </div>

                                <div class="bank-data-item">
                                    <div class="bank-data-label">Bank</div>
                                    <div class="bank-data-val-row">
                                        <span class="bank-data-val">Revolut</span>
                                    </div>
                                </div>

                                <div class="bank-data-item">
                                    <div class="bank-data-label">Sort Code</div>
                                    <div class="bank-data-val-row">
                                        <span class="bank-data-val" id="copySortCode">23-01-20</span>
                                        <button type="button" class="btn-copy-bank" onclick="copyBankDetail('23-01-20', this)" title="Copy Sort Code">Copy</button>
                                    </div>
                                </div>

                                <div class="bank-data-item">
                                    <div class="bank-data-label">Account Number</div>
                                    <div class="bank-data-val-row">
                                        <span class="bank-data-val" id="copyAcctNum">56933694</span>
                                        <button type="button" class="btn-copy-bank" onclick="copyBankDetail('56933694', this)" title="Copy Account Number">Copy</button>
                                    </div>
                                </div>
                            </div>

                            <div class="bank-reference-hint">
                                💡 <strong>Reference Tip:</strong> Please use your <em>Full Name</em> or <em>Phone Number</em> as the payment reference when making the transfer.
                            </div>
                        </div>

                        <!-- Proof of Payment Upload Input -->
                        <div class="proof-upload-wrapper">
                            <label class="booking-input-label" for="paymentProofInput">
                                Attach Screenshot of Payment Proof *
                                <span class="upload-optional-hint">(JPG, PNG, WEBP, or PDF • Max 10MB)</span>
                            </label>
                            <div class="proof-upload-dropzone" id="proofDropzone" onclick="document.getElementById('paymentProofInput').click()">
                                <input type="file" name="payment_proof" id="paymentProofInput" accept="image/*,application/pdf" style="display: none;" onchange="handleProofFileSelect(this)">
                                <div class="dropzone-content" id="dropzoneDefaultState">
                                    <div class="dropzone-icon">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                        </svg>
                                    </div>
                                    <div class="dropzone-text">
                                        <strong>Click to upload payment screenshot</strong> or drag & drop here
                                    </div>
                                    <span class="dropzone-sub">Proof will be sent directly to admin for instant approval</span>
                                </div>

                                <div class="dropzone-selected-preview" id="dropzoneSelectedState" style="display: none;">
                                    <div class="preview-file-icon">📸</div>
                                    <div class="preview-file-info">
                                        <strong id="previewFileName">screenshot.jpg</strong>
                                        <span id="previewFileSize">1.2 MB</span>
                                    </div>
                                    <button type="button" class="btn-remove-proof" onclick="removeProofFile(event)">✕ Change</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Agreement Checkbox -->
                    <label class="booking-terms-check">
                        <input type="checkbox" id="agreePolicies" name="policies_agreed" value="1" required>
                        <span>I confirm that I have transferred my 30% deposit to the Revolut account above, attached my proof, and agree to Ella Beauty's <strong>Booking Policies</strong>.</span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-appointment" id="submitAppointmentBtn">
                        <span>Confirm Appointment & Submit Proof</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <!-- Confirmed Success State -->
                <div class="booking-confirmed-card" id="bookingConfirmedCard">
                    <div class="confirmed-icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3 style="font-family: var(--font-heading); font-size: 1.8rem; color: #160D4A; margin-bottom: 0.5rem;">Appointment Reserved!</h3>
                    <p style="color: #475569; max-width: 480px; margin: 0 auto 1.5rem; line-height: 1.7;">
                        Thank you, <strong id="confirmedNameDisplay">Client</strong>! Your booking request has been dispatched. Our team will contact you via WhatsApp/SMS with your 30% deposit confirmation details.
                    </p>
                    <a href="https://wa.me/447123456789" target="_blank" class="btn-submit-appointment" style="max-width: 320px; margin: 0 auto; background: #25D366; text-decoration: none;">
                        <span>Chat on WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Right Side: Before You Book Checklist Card -->
            <div class="booking-checklist-card">
                <div class="checklist-header">
                    <span class="checklist-badge">Important Checklist</span>
                    <h3>Before You Book</h3>
                    <p>Please make sure you have checked all details prior to securing your chair:</p>
                </div>

                <ul class="checklist-items-list">
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Your hairstyle</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Size</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Length</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Appointment date</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Appointment time</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Appointment location</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Total price</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>30% deposit amount</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-item-check">✓</div>
                        <span>Booking policies</span>
                    </li>
                </ul>

                <div class="checklist-advisory-note">
                    If you're unsure about anything, please ask before paying your deposit. Once your deposit has been received and your appointment confirmed, you are agreeing to Ella Beauty's booking policies.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================================================
     3. COMPLETE PRICING CATALOG / MENU SECTION
     ========================================================================== -->
<section class="pricing-catalog-section" id="pricingMenu">
    <div class="pricing-catalog-container">
        
        <div class="catalog-section-header">
            <span class="policies-badge-eyebrow">Official Menu</span>
            <h2 class="policies-section-title">Complete <span>Pricing & Services</span></h2>
            <p class="policies-section-desc">
                Browse our complete hairstyle collection with transparent pricing, estimated durations, and 30% deposit calculations.
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="catalog-category-filter">
            <button type="button" class="price-filter-btn active" onclick="filterCatalog('all', this)">All Styles</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('boho', this)">Boho Braids</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('knotless', this)">Knotless Braids</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('fulani', this)">Fulani / Tribal</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('stitch', this)">Stitch Braids</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('weave', this)">Half Weave</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('twists_ext', this)">Twists (Extensions)</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('twists_nat', this)">Twists (Natural)</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('french', this)">French Curls</button>
            <button type="button" class="price-filter-btn" onclick="filterCatalog('diy', this)">DIY Services</button>
        </div>

        <!-- Pricing Cards Grid -->
        <div class="pricing-cards-grid">
            
            <!-- 1. BOHO BRAIDS -->
            <div class="price-card-item" data-cat="boho">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Boho Braids</span>
                        <h3 class="price-card-title">Small Boho Braids — Bob / Shoulder Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£120.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £36.00</div>
                    <p class="price-card-notes">
                        Requires two types of extensions. Braiding hair included. Human hair bulk bundle is not included and must be selected as an add-on.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('boho_small_bob')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="boho">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Boho Braids</span>
                        <h3 class="price-card-title">Small Boho Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 8 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        Requires two types of extensions. Braiding hair is included in the service price and will be provided.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('boho_small_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="boho">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Boho Braids</span>
                        <h3 class="price-card-title">Small Boho Braids — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 10 hours</div>
                        <div class="stat-cost">£180.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £54.00</div>
                    <p class="price-card-notes">
                        Requires two types of extensions. Braiding hair is included in the service price and will be provided.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('boho_small_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="boho">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Boho Braids</span>
                        <h3 class="price-card-title">Smedium Boho Braids — Bob / Shoulder Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£100.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £30.00</div>
                    <p class="price-card-notes">
                        Braiding hair included. Human hair bulk bundle not included (100-200g recommended based on personal preference).
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('boho_smedium_bob')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="boho">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Boho Braids</span>
                        <h3 class="price-card-title">Smedium Boho Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£150.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £45.00</div>
                    <p class="price-card-notes">
                        Requires two types of extensions. Braiding hair is included in the service price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('boho_smedium_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 2. KNOTLESS BRAIDS -->
            <div class="price-card-item" data-cat="knotless">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Knotless Braids</span>
                        <h3 class="price-card-title">Small Knotless Braids — Bob Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£120.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £36.00</div>
                    <p class="price-card-notes">
                        Braiding hair is included. Your natural hair must be at least 4 inches long. Appointment times are estimated.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('knotless_small_bob')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="knotless">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Knotless Braids</span>
                        <h3 class="price-card-title">Small Knotless Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        Braiding hair is included. Your natural hair must be at least 4 inches long.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('knotless_small_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="knotless">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Knotless Braids</span>
                        <h3 class="price-card-title">Small Knotless Braids — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 8 hours</div>
                        <div class="stat-cost">£180.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £54.00</div>
                    <p class="price-card-notes">
                        Braiding hair is included. Your natural hair must be at least 4 inches long.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('knotless_small_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 3. FULANI BRAIDS / TRIBAL -->
            <div class="price-card-item" data-cat="fulani">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Fulani / Tribal</span>
                        <h3 class="price-card-title">Small – Shoulder Length / Flip Over Braids</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£100.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £30.00</div>
                    <p class="price-card-notes">
                        Braiding extensions are included in the price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('fulani_small_shoulder')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="fulani">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Fulani / Tribal</span>
                        <h3 class="price-card-title">Small Fulani French Curls Braids — Mid-Back</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£150.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £45.00</div>
                    <p class="price-card-notes">
                        Hair extensions are not included in this service price. Extensions are available for purchase through us or our trusted vendor.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('fulani_french_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="fulani">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Fulani / Tribal</span>
                        <h3 class="price-card-title">Small Fulani Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£150.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £45.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions included. Mix of 2+ colors will incur an add-on charge. Natural hair must be at least 4 inches.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('fulani_small_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="fulani">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Fulani / Tribal</span>
                        <h3 class="price-card-title">Smedium Fulani Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£120.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £36.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions are included in the service price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('fulani_smedium_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="fulani">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Fulani / Tribal</span>
                        <h3 class="price-card-title">Smedium Fulani Braids — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 8 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions are included in the service price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('fulani_smedium_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 4. STITCH BRAIDS -->
            <div class="price-card-item" data-cat="stitch">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Stitch Braids</span>
                        <h3 class="price-card-title">8 Stitch Braids</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 3 hours</div>
                        <div class="stat-cost">£60.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £18.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions are included in the service price. Natural hair must be at least 4 inches long.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('stitch_8')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="stitch">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Stitch Braids</span>
                        <h3 class="price-card-title">6 Stitch Braids</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 3 hours</div>
                        <div class="stat-cost">£80.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £24.00</div>
                    <p class="price-card-notes">
                        Braiding hair is included. Custom color mix incurs an additional charge.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('stitch_6')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="stitch">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Stitch Braids</span>
                        <h3 class="price-card-title">Small Alicia Keys Braids — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£120.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £36.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions included. Natural hair must be at least 4 inches long.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('alicia_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="stitch">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Stitch Braids</span>
                        <h3 class="price-card-title">Small Alicia Keys Braids — Bum Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 6 hours</div>
                        <div class="stat-cost">£150.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £45.00</div>
                    <p class="price-card-notes">
                        Braiding hair extensions included. Natural hair must be at least 4 inches long.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('alicia_bum')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 5. HALF WEAVE / SEW-INS -->
            <div class="price-card-item" data-cat="weave">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Half Weave / Sew-Ins</span>
                        <h3 class="price-card-title">Jayda Wayda Braids</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£100.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £30.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in this service fee.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('jayda_wayda')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 6. TWISTS (WITH EXTENSIONS) -->
            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Mini Twists</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        Shoulder length base; longer length attracts extra charge. Extensions not included in base fee.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_mini_ext')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Micro Twists (14–20 inches)</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 9 hours</div>
                        <div class="stat-cost">£220.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £66.00</div>
                    <p class="price-card-notes">
                        Shoulder length base; longer length attracts extra charge. Extensions not included in base fee.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_micro_14_20')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Micro Twists (20 inches & above)</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 9 hours</div>
                        <div class="stat-cost">£250.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £75.00</div>
                    <p class="price-card-notes">
                        Shoulder length base; longer length attracts extra charge. Extensions not included in base fee.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_micro_20_above')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Small Twists — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the braiding fee but can be added on when booking.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_small_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Small Twists — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£150.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £45.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the braiding fee but can be added on when booking.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_small_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Smedium Twists — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£120.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £36.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the braiding fee but can be added on when booking.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_smedium_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_ext">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Extensions)</span>
                        <h3 class="price-card-title">Smedium Twists — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£140.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £42.00</div>
                    <p class="price-card-notes">
                        This service requires extensions, which are not included in the braiding fee.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_smedium_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 7. TWISTS (NATURAL HAIR ONLY) -->
            <div class="price-card-item" data-cat="twists_nat">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Natural Hair)</span>
                        <h3 class="price-card-title">Medium Twist (Natural Hair)</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 5 hours</div>
                        <div class="stat-cost">£60.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £18.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the price above as this is a service with just your natural hair.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_nat_med')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_nat">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Natural Hair)</span>
                        <h3 class="price-card-title">Small Twist (Natural Hair)</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 6 hours</div>
                        <div class="stat-cost">£90.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £27.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the price above as this is a service with just your natural hair.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_nat_small')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="twists_nat">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">Twists (Natural Hair)</span>
                        <h3 class="price-card-title">Mini Twist (Natural Hair)</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£100.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £30.00</div>
                    <p class="price-card-notes">
                        Extensions are not included in the price above, as this is a service with just your natural hair.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('twists_nat_mini')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 8. FRENCH CURLS / ITALIAN CURLS (BOHO STYLE) -->
            <div class="price-card-item" data-cat="french">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">French Curls (Boho)</span>
                        <h3 class="price-card-title">Smedium French Curls Braids — Shoulder Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 6 hours</div>
                        <div class="stat-cost">£145.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £43.50</div>
                    <p class="price-card-notes">
                        Hair extensions are not included in this service price (available for purchase through us or trusted vendor).
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('french_smedium_shoulder')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="french">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">French Curls (Boho)</span>
                        <h3 class="price-card-title">Smedium French Curls Braids — Mid-Back Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 6 hours</div>
                        <div class="stat-cost">£160.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £48.00</div>
                    <p class="price-card-notes">
                        Hair extensions are not included in this service price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('french_smedium_midback')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="french">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">French Curls (Boho)</span>
                        <h3 class="price-card-title">Smedium French Curls Braids — Waist Length</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 7 hours</div>
                        <div class="stat-cost">£180.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £54.00</div>
                    <p class="price-card-notes">
                        Hair extensions are not included in this service price.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('french_smedium_waist')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <!-- 9. DIY -->
            <div class="price-card-item" data-cat="diy">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">DIY Pre-Parting</span>
                        <h3 class="price-card-title">Jayda Wayda Stitch Cornrows Only</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 2h 30m</div>
                        <div class="stat-cost">£30.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £9.00</div>
                    <p class="price-card-notes">
                        Cornrows only without extensions.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('diy_jayda_stitch')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

            <div class="price-card-item" data-cat="diy">
                <div>
                    <div class="price-card-header">
                        <span class="price-card-category-tag">DIY Pre-Parting</span>
                        <h3 class="price-card-title">Large Pre-Parts</h3>
                    </div>
                    <div class="price-card-stats-row">
                        <div class="stat-duration">⏱️ 1h 30m</div>
                        <div class="stat-cost">£30.00</div>
                    </div>
                    <div class="price-card-deposit-chip">30% Deposit: £9.00</div>
                    <p class="price-card-notes">
                        This service is for those who do their own hair by themselves but struggle to get a proper part.
                    </p>
                </div>
                <button type="button" class="btn-select-style-card" onclick="selectFromCatalog('diy_large_preparts')">
                    <span>Book This Style &rarr;</span>
                </button>
            </div>

        </div>

    </div>
</section>

<!-- ==========================================================================
     4. COMPREHENSIVE BOOKING POLICIES SECTION (ALL POLICIES INCLUDED)
     ========================================================================== -->
<section class="booking-policies-section" id="policiesSection">
    <div class="policies-container">
        
        <div class="policies-section-header">
            <span class="policies-badge-eyebrow">Terms & Standards</span>
            <h2 class="policies-section-title">Ella Beauty <span>Policies</span></h2>
            <p class="policies-section-desc">
                Please take a moment to read our policies carefully. These guidelines ensure a smooth, professional, and enjoyable experience for every client.
            </p>
        </div>

        <div class="policies-cards-grid">
            
            <!-- Policy 1: 30% Deposit & Payments -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">🤎</div>
                    <h4>30% Deposit & Payments</h4>
                </div>
                <div class="policy-card-tagline">SECURING YOUR APPOINTMENT 🤎</div>
                <div class="policy-card-content">
                    <p>A 30% deposit is required to secure your appointment.</p>
                    <p>Your appointment is not confirmed until the 30% deposit has been received and acknowledged by Ella Beauty.</p>
                    <p>Before paying your deposit, please make sure you are completely happy with your <strong>STYLE • SIZE • LENGTH • DATE • TIME • LOCATION • TOTAL PRICE</strong>.</p>
                    <p>The remaining 70% balance is due according to the payment terms provided at the time of booking.</p>
                    <p>Deposits are non-refundable once your appointment has been confirmed, except where Ella Beauty cancels the appointment.</p>
                    <p><em>Please do not make a deposit if you are unsure about your appointment.</em></p>
                </div>
            </div>

            <!-- Policy 2: Cancellations -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">🗓️</div>
                    <h4>Cancellations</h4>
                </div>
                <div class="policy-card-tagline">Fair Communication Policy</div>
                <div class="policy-card-content">
                    <p>I understand that plans can change. If you need to cancel your appointment, please communicate this as early as possible.</p>
                    <p>Once an appointment has been confirmed, the 30% deposit is non-refundable.</p>
                    <p>Repeated cancellations or failure to attend an appointment may affect your ability to book future appointments.</p>
                </div>
            </div>

            <!-- Policy 3: Rescheduling -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">🔄</div>
                    <h4>Rescheduling</h4>
                </div>
                <div class="policy-card-tagline">Flexibility & Notice Terms</div>
                <div class="policy-card-content">
                    <p>If something comes up and you need to change your appointment, please contact Ella Beauty as soon as possible.</p>
                    <p>Where sufficient notice is provided, your deposit may be transferred to another available appointment, subject to availability and the rescheduling terms provided at the time of booking.</p>
                    <p>Repeated changes or late requests may require a new deposit.</p>
                </div>
            </div>

            <!-- Policy 4: Late Arrivals -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">⏰</div>
                    <h4>Late Arrivals</h4>
                </div>
                <div class="policy-card-tagline">Punctuality & Time Management</div>
                <div class="policy-card-content">
                    <p>Your appointment time is reserved specifically for you.</p>
                    <p>A grace period is allowed. After the grace period, a late fee may apply.</p>
                    <p>Significant lateness may affect the time available for your appointment and may result in a shortened hairstyle, a change to the requested style or rescheduling.</p>
                    <p>If you know you're running late, please let me know as soon as possible.</p>
                </div>
            </div>

            <!-- Policy 5: Preparing Your Hair -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">✨</div>
                    <h4>Preparing Your Hair</h4>
                </div>
                <div class="policy-card-tagline">Hair Health & Best Results</div>
                <div class="policy-card-content">
                    <p>For the best braiding experience, please arrive with your hair clean, fully dry, detangled and free from excessive products.</p>
                    <p>If your hair requires extensive detangling or preparation, additional time or charges may apply.</p>
                    <p>If you have particularly thick, long or difficult-to-manage hair, please let me know before your appointment so sufficient time can be allocated.</p>
                </div>
            </div>

            <!-- Policy 6: Mobile Braiding / Home Service -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">🚗</div>
                    <h4>Mobile Braiding / Home Service</h4>
                </div>
                <div class="policy-card-tagline">At-Home Convenience</div>
                <div class="policy-card-content">
                    <p>Your braiding appointment can be done from the comfort of your own space.</p>
                    <p>For your appointment, please provide:</p>
                    <ul class="policy-bullet-list">
                        <li>A comfortable chair</li>
                        <li>A clean and suitable working area</li>
                        <li>Good lighting</li>
                        <li>Access to a power socket where required</li>
                        <li>Enough space for the braiding setup</li>
                    </ul>
                </div>
            </div>

            <!-- Policy 7: Travel Appointments -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">📍</div>
                    <h4>Travel Appointments</h4>
                </div>
                <div class="policy-card-tagline">Beyond Usual Service Area</div>
                <div class="policy-card-content">
                    <p>Travel appointments are available outside the usual service area.</p>
                    <p>Your travel fee will depend on your location and distance. Please provide your full postcode when enquiring so your travel fee can be confirmed before your appointment is secured.</p>
                </div>
            </div>

            <!-- Policy 8: Kids' Appointments -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">🌸</div>
                    <h4>Kids' Appointments</h4>
                </div>
                <div class="policy-card-tagline">Gentle Care for Little Crowns</div>
                <div class="policy-card-content">
                    <p>Ella Beauty offers selected hairstyles for children.</p>
                    <p>Parents/guardians are responsible for ensuring that the child is comfortable and able to remain seated throughout the appointment.</p>
                    <p>Please provide the child's age and desired hairstyle when booking.</p>
                </div>
            </div>

            <!-- Policy 9: Client Experience & Media -->
            <div class="policy-card-item">
                <div class="policy-card-top">
                    <div class="policy-card-icon">👑</div>
                    <h4>Client Experience & Privacy</h4>
                </div>
                <div class="policy-card-tagline">COME FOR THE HAIR. STAY FOR THE EXPERIENCE. 🤎</div>
                <div class="policy-card-content">
                    <p>Braiding can take several hours, so I want you to feel comfortable throughout your appointment:</p>
                    <ul class="policy-bullet-list">
                        <li>✨ A clean setup</li>
                        <li>✨ Attention to detail</li>
                        <li>✨ A relaxed atmosphere</li>
                        <li>✨ Snacks and drinks as a courtesy</li>
                        <li>✨ A personalised braiding experience</li>
                    </ul>
                    <p style="margin-top: 1rem;"><strong>Photos & Videos:</strong> With your permission, Ella Beauty may take photos or short videos of your hairstyle after your appointment for social media and portfolio purposes. If you prefer not to be photographed or recorded, please let me know. Your privacy and comfort come first.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ==========================================================================
     LIGHTBOX PREVIEW MODAL FOR CATEGORY LOOKBOOK IMAGES
     ========================================================================== -->
<div id="bookingLightboxModal" class="booking-lightbox-overlay" style="display: none;" onclick="closeBookingLightbox(event)">
    <div class="booking-lightbox-container" onclick="event.stopPropagation()">
        <button type="button" class="btn-lightbox-close" onclick="closeBookingLightbox()" aria-label="Close image preview">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        
        <div class="booking-lightbox-body">
            <button type="button" class="btn-lightbox-nav prev" id="lightboxPrevBtn" onclick="navigateLightbox(-1)" aria-label="Previous Lookbook image">
                ‹
            </button>
            
            <div class="lightbox-image-stage">
                <img id="lightboxMainImage" src="" alt="Lookbook Artwork Preview" class="lightbox-main-img">
                <div class="lightbox-info-overlay">
                    <div class="lightbox-info-left">
                        <span class="lightbox-category-tag" id="lightboxCategoryTag">Category Look</span>
                        <h4 class="lightbox-title-text" id="lightboxTitleText">Hairstyle Preview</h4>
                    </div>
                    <div class="lightbox-counter-pill" id="lightboxCounter">1 / 3</div>
                </div>
            </div>
            
            <button type="button" class="btn-lightbox-nav next" id="lightboxNextBtn" onclick="navigateLightbox(1)" aria-label="Next Lookbook image">
                ›
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Global state for category lookbook images
    let currentGalleryImages = [];
    let currentCategoryName = 'Ella Beauty';
    let currentStyleName = 'Hairstyle Inspiration';
    let activeLightboxIndex = 0;

    // Update live price breakdown and category lookbook photos whenever hairstyle is selected
    function updatePriceCalculation() {
        const selectEl = document.getElementById('bookHairstyle');
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        
        if (!selectedOption || !selectedOption.dataset.price) {
            document.getElementById('livePriceBox').style.display = 'none';
            if (document.getElementById('depositSectionAmount')) {
                document.getElementById('depositSectionAmount').textContent = '£0.00';
            }
            return;
        }

        const price = parseFloat(selectedOption.dataset.price);
        const duration = selectedOption.dataset.time || '';
        const extNote = selectedOption.dataset.ext || '';
        const styleName = selectedOption.dataset.name || selectedOption.text.split('(')[0].trim();
        const categoryName = selectedOption.dataset.category || 'Braiding Service';

        currentCategoryName = categoryName;
        currentStyleName = styleName;

        const deposit = (price * 0.3).toFixed(2);
        const balance = (price * 0.7).toFixed(2);

        // Update hidden form inputs for backend processing
        if (document.getElementById('hiddenServiceId')) {
            document.getElementById('hiddenServiceId').value = selectedOption.dataset.id || '';
        }
        if (document.getElementById('hiddenServiceName')) {
            document.getElementById('hiddenServiceName').value = styleName;
        }
        if (document.getElementById('hiddenTotalPrice')) {
            document.getElementById('hiddenTotalPrice').value = price.toFixed(2);
        }

        // Update compact summary card elements
        if (document.getElementById('summaryCategoryPill')) {
            document.getElementById('summaryCategoryPill').textContent = categoryName;
        }
        document.getElementById('summaryStyleName').textContent = styleName;
        document.getElementById('summaryDuration').textContent = `⏱️ ${duration}`;
        document.getElementById('summaryTotalPrice').textContent = `£${price.toFixed(2)}`;
        document.getElementById('summaryDepositPrice').textContent = `£${deposit}`;
        document.getElementById('summaryBalancePrice').textContent = `£${balance}`;
        
        const extNoteEl = document.getElementById('summaryExtensionsNote');
        const extRowEl = document.getElementById('summaryExtensionsNoteRow');
        if (extNoteEl && extRowEl) {
            if (extNote && extNote.trim() !== '') {
                extNoteEl.textContent = extNote;
                extRowEl.style.display = 'flex';
            } else {
                extRowEl.style.display = 'none';
            }
        }

        if (document.getElementById('depositSectionAmount')) {
            document.getElementById('depositSectionAmount').textContent = `£${deposit}`;
        }

        // Render Category Lookbook Preview (up to 3 images with click-to-preview lightbox)
        const previewWrap = document.getElementById('serviceGalleryPreview');
        const previewGrid = document.getElementById('servicePreviewGrid');
        const countBadge = document.getElementById('galleryPreviewCount');
        
        currentGalleryImages = [];
        try {
            if (selectedOption.dataset.images) {
                currentGalleryImages = JSON.parse(selectedOption.dataset.images);
            }
        } catch (e) {
            currentGalleryImages = [];
        }

        if (previewWrap && previewGrid) {
            if (currentGalleryImages && currentGalleryImages.length > 0) {
                previewGrid.innerHTML = '';
                const maxThree = currentGalleryImages.slice(0, 3);
                
                if (countBadge) {
                    countBadge.textContent = `${maxThree.length} Photo${maxThree.length > 1 ? 's' : ''}`;
                }

                maxThree.forEach((imgUrl, i) => {
                    const card = document.createElement('div');
                    card.className = 'selected-gallery-thumb-item';
                    card.title = 'Click to enlarge and preview';
                    card.onclick = () => openBookingLightbox(i);
                    card.innerHTML = `
                        <img src="${imgUrl}" alt="${categoryName} Look ${i + 1}" loading="lazy" onerror="this.src='{{ asset('assets/images/braided4.avif') }}'">
                        <div class="thumb-hover-overlay">
                            <span class="thumb-zoom-icon">🔍</span>
                        </div>
                        <span class="thumb-corner-badge">#${i + 1}</span>
                    `;
                    previewGrid.appendChild(card);
                });
                previewWrap.style.display = 'block';
            } else {
                previewWrap.style.display = 'none';
            }
        }

        document.getElementById('livePriceBox').style.display = 'block';
    }

    // =========================================================================
    // LIGHTBOX PREVIEW MODAL LOGIC
    // =========================================================================
    function openBookingLightbox(index) {
        if (!currentGalleryImages || currentGalleryImages.length === 0) return;
        activeLightboxIndex = (index >= 0 && index < currentGalleryImages.length) ? index : 0;
        updateLightboxDisplay();

        const modal = document.getElementById('bookingLightboxModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBookingLightbox(event) {
        if (event && event.target && event.target.id !== 'bookingLightboxModal' && !event.target.closest('.btn-lightbox-close')) {
            return;
        }
        const modal = document.getElementById('bookingLightboxModal');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function navigateLightbox(direction) {
        if (!currentGalleryImages || currentGalleryImages.length <= 1) return;
        activeLightboxIndex = (activeLightboxIndex + direction + currentGalleryImages.length) % currentGalleryImages.length;
        updateLightboxDisplay();
    }

    function updateLightboxDisplay() {
        const imgEl = document.getElementById('lightboxMainImage');
        const titleEl = document.getElementById('lightboxTitleText');
        const tagEl = document.getElementById('lightboxCategoryTag');
        const counterEl = document.getElementById('lightboxCounter');
        const prevBtn = document.getElementById('lightboxPrevBtn');
        const nextBtn = document.getElementById('lightboxNextBtn');

        const currentSrc = currentGalleryImages[activeLightboxIndex];
        if (imgEl) {
            imgEl.style.opacity = '0';
            setTimeout(() => {
                imgEl.src = currentSrc;
                imgEl.onload = () => { imgEl.style.opacity = '1'; };
                imgEl.onerror = () => {
                    imgEl.src = "{{ asset('assets/images/braided4.avif') }}";
                    imgEl.style.opacity = '1';
                };
            }, 100);
        }

        if (tagEl) tagEl.textContent = currentCategoryName;
        if (titleEl) titleEl.textContent = `${currentStyleName} (Inspiration #${activeLightboxIndex + 1})`;
        if (counterEl) counterEl.textContent = `${activeLightboxIndex + 1} / ${currentGalleryImages.length}`;

        if (prevBtn && nextBtn) {
            if (currentGalleryImages.length <= 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
            }
        }
    }

    // Keyboard support for Lightbox
    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('bookingLightboxModal');
        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') closeBookingLightbox();
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
            if (e.key === 'ArrowRight') navigateLightbox(1);
        }
    });

    // Copy bank detail with toast feedback
    function copyBankDetail(text, btn) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                const orig = btn.innerText;
                btn.innerText = 'Copied! ✓';
                btn.style.background = '#10B981';
                btn.style.color = '#FFFFFF';
                setTimeout(() => {
                    btn.innerText = orig;
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            });
        } else {
            const input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            const orig = btn.innerText;
            btn.innerText = 'Copied! ✓';
            setTimeout(() => { btn.innerText = orig; }, 2000);
        }
    }

    // Proof file handlers
    function handleProofFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('previewFileName').textContent = file.name;
            document.getElementById('previewFileSize').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            document.getElementById('dropzoneDefaultState').style.display = 'none';
            document.getElementById('dropzoneSelectedState').style.display = 'flex';
        }
    }

    function removeProofFile(event) {
        event.stopPropagation();
        const input = document.getElementById('paymentProofInput');
        input.value = '';
        document.getElementById('dropzoneSelectedState').style.display = 'none';
        document.getElementById('dropzoneDefaultState').style.display = 'block';
    }

    // Select style directly from pricing cards
    function selectFromCatalog(optionValue) {
        const selectEl = document.getElementById('bookHairstyle');
        if (!selectEl) return;

        let matched = false;
        for (let i = 0; i < selectEl.options.length; i++) {
            const opt = selectEl.options[i];
            if (opt.value == optionValue || 
                (opt.dataset.name && opt.dataset.name.toLowerCase().includes(optionValue.toLowerCase())) ||
                opt.text.toLowerCase().includes(optionValue.toLowerCase())) {
                selectEl.selectedIndex = i;
                matched = true;
                break;
            }
        }
        
        if (!matched && optionValue) {
            selectEl.value = optionValue;
        }

        updatePriceCalculation();
        
        // Scroll smoothly to appointment form
        const formEl = document.getElementById('appointmentForm');
        if (formEl) {
            formEl.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Filter catalog pricing cards
    function filterCatalog(category, buttonEl) {
        document.querySelectorAll('.price-filter-btn').forEach(btn => btn.classList.remove('active'));
        buttonEl.classList.add('active');

        const cards = document.querySelectorAll('.price-card-item');
        cards.forEach(card => {
            if (category === 'all' || card.dataset.cat === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function selectDedicatedTime(element, timeVal) {
        document.querySelectorAll('.booking-time-chip').forEach(chip => chip.classList.remove('active'));
        element.classList.add('active');
        document.getElementById('selectedDedicatedTime').value = timeVal;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const serviceParam = urlParams.get('service') || urlParams.get('service_id');
        if (serviceParam) {
            const selectEl = document.getElementById('bookHairstyle');
            if (selectEl) {
                for (let i = 0; i < selectEl.options.length; i++) {
                    const opt = selectEl.options[i];
                    if (opt.value == serviceParam || 
                        opt.dataset.id == serviceParam ||
                        opt.text.toLowerCase().includes(serviceParam.toLowerCase())) {
                        selectEl.selectedIndex = i;
                        updatePriceCalculation();
                        break;
                    }
                }
            }
        }
    });
</script>
@endsection
