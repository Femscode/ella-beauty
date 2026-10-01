@extends('frontend.master')

@section('title', 'Contact Ella Beauty | Mobile Braiding & Home Salon Inquiries')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/css/contact1.css') }}?v={{ time() }}">
<style>
    .contact-form-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 10px 35px rgba(39, 24, 117, 0.08);
        border: 1px solid #E2E8F0;
    }

    .form-group-custom {
        margin-bottom: 20px;
    }

    .form-label-custom {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        color: #160D4A;
        margin-bottom: 8px;
    }

    .form-input-custom {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        font-family: inherit;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s;
    }

    .form-input-custom:focus {
        border-color: #38BDF8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="services-hero" style="background: linear-gradient(135deg, #160D4A 0%, #271875 100%); padding: 120px 0 60px; color: #FFFFFF; text-align: center;">
    <div class="container">
        <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #38BDF8; display: block; margin-bottom: 8px;">We're Here For You</span>
        <h1 style="font-family: var(--font-heading, 'Playfair Display', serif); font-size: 2.8rem; font-weight: 800; margin-bottom: 12px;">Get In Touch with Ella Beauty</h1>
        <p style="color: #BAE6FD; max-width: 600px; margin: 0 auto; font-size: 1.05rem; line-height: 1.6;">
            Have questions about styling options, mobile braiding coverage in Luton, or custom travel appointments? Send us a message or chat directly.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" style="padding: 70px 0; background: #F8FAFC;">
    <div class="container">
        @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; padding: 16px 20px; border-radius: 12px; margin-bottom: 32px; font-weight: 600; display: flex; align-items: center; gap: 12px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: flex-start;">

            <!-- Left: Contact Details -->
            <div class="contact-info" style="background: #FFFFFF; border-radius: 20px; padding: 36px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px rgba(39, 24, 117, 0.05);">
                <h2 style="font-family: var(--font-heading, 'Playfair Display', serif); font-size: 1.8rem; color: #160D4A; margin-bottom: 12px;">Let's Discuss Your Style</h2>
                <p style="color: #64748B; font-size: 0.95rem; line-height: 1.6; margin-bottom: 28px;">
                    Whether you are preparing for an event, seeking protective hair care advice, or booking group sessions, we'd love to hear from you.
                </p>

                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(56, 189, 248, 0.15); color: #0284C7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; color: #160D4A; font-weight: 700;">Service Location</h4>
                            <p style="color: #64748B; font-size: 0.9rem; margin-top: 2px;">Luton & Surrounding Areas, United Kingdom (Mobile & Travel Available)</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(37, 211, 102, 0.15); color: #15803D; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; color: #160D4A; font-weight: 700;">Phone / WhatsApp</h4>
                            <p style="margin-top: 2px;"><a href="tel:+447350166691" style="color: #0284C7; font-weight: 600; text-decoration: none;">+44 7424 928399</a></p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(39, 24, 117, 0.12); color: #271875; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; color: #160D4A; font-weight: 700;">Email</h4>
                            <p style="margin-top: 2px;"><a href="mailto:contact@ellabeauty.co.uk" style="color: #0284C7; text-decoration: none;">contact@ellabeauty.co.uk</a></p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #E2E8F0;">
                    <a href="{{ route('booking') }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #38BDF8 0%, #0284C7 100%); color: #FFFFFF; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 0.95rem;">
                        <span>Book an Appointment</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right: Interactive Contact Form -->
            <div class="contact-form-card">
                <h3 style="font-family: var(--font-heading, 'Playfair Display', serif); font-size: 1.6rem; color: #160D4A; margin-bottom: 20px;">Send Us a Message</h3>

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="form-group-custom">
                        <label class="form-label-custom">Your Full Name *</label>
                        <input type="text" name="name" class="form-input-custom" required placeholder="e.g. Rachel Adams" value="{{ old('name') }}">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Email Address *</label>
                            <input type="email" name="email" class="form-input-custom" required placeholder="rachel@example.com" value="{{ old('email') }}">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Phone / WhatsApp</label>
                            <input type="tel" name="phone" class="form-input-custom" placeholder="+44 7123..." value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Subject / Hairstyle Inquiry</label>
                        <input type="text" name="subject" class="form-input-custom" placeholder="e.g. Inquiry about Boho Braids mobile service" value="{{ old('subject') }}">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Your Message *</label>
                        <textarea name="message" class="form-input-custom" rows="4" required placeholder="How can we help you? Let us know the date, location, or hair questions you have...">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" style="width: 100%; background: #271875; color: #FFFFFF; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 1rem; border: none; cursor: pointer; transition: background 0.2s;">
                        Send Inquiry Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection