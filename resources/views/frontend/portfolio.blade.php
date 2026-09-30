@extends('frontend.master')

@section('header')
    <link rel="stylesheet" href="{{ url('assets/css/portfolio.css') }}">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="portfolio-hero">
        <div class="portfolio-hero-container">
            <div class="portfolio-hero-content">
                <h1 class="portfolio-hero-title">Our Portfolio</h1>
                <p class="portfolio-hero-subtitle">Crafting Visibility That Can't Be Missed. Explore our thoughtful, high-impact merchandise designs including journals, water bottles, tote bags, apparel, and more that create lasting connections with your audience.</p>
            </div>
        </div>
    </section>

    <!-- Portfolio Filter Section -->
    <section class="portfolio-filter-section">
        <div class="portfolio-container">
            <div class="filter-tabs">
                <button class="filter-btn active" data-filter="all">All Products</button>
                <button class="filter-btn" data-filter="journals">Journals</button>
                <button class="filter-btn" data-filter="drinkware">Drinkware</button>
                <button class="filter-btn" data-filter="bags">Bags & Totes</button>
                <button class="filter-btn" data-filter="apparel">Apparel</button>
            </div>
        </div>
    </section>

    <!-- Portfolio Gallery Section -->
    <section class="portfolio-gallery-section">
        <div class="portfolio-container">
            <div class="portfolio-grid">
                <!-- Portfolio Item 1 -->
                <div class="portfolio-item" data-category="journals">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port1.png') }}" alt="Custom Corporate Journal Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Executive Journal Collection</h3>
                                    <p>Premium leather-bound journals with custom branding</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Journals</span>
                                        <span class="tag">Corporate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 2 -->
                <div class="portfolio-item" data-category="drinkware">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port2.png') }}" alt="Custom Water Bottle Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Eco-Friendly Water Bottles</h3>
                                    <p>Sustainable drinkware with impactful branding</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Drinkware</span>
                                        <span class="tag">Eco-Friendly</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 3 -->
                <div class="portfolio-item" data-category="bags">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port3.png') }}" alt="Custom Tote Bag Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Canvas Tote Collection</h3>
                                    <p>Durable tote bags with eye-catching designs</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Bags & Totes</span>
                                        <span class="tag">Canvas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 4 -->
                <div class="portfolio-item" data-category="apparel">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port4.png') }}" alt="Custom T-Shirt Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Premium T-Shirt Line</h3>
                                    <p>High-quality apparel with memorable branding</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Apparel</span>
                                        <span class="tag">T-Shirts</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 5 -->
                <div class="portfolio-item" data-category="drinkware">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port11.png') }}" alt="Custom Coffee Mug Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Coffee Mug Collection</h3>
                                    <p>Ceramic mugs that make every sip memorable</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Drinkware</span>
                                        <span class="tag">Ceramic</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 6 -->
                <div class="portfolio-item" data-category="journals">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port6.png') }}" alt="Custom Notebook Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Spiral Notebook Collection</h3>
                                    <p>Functional notebooks with creative covers</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Journals</span>
                                        <span class="tag">Notebooks</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 7 -->
                <div class="portfolio-item" data-category="bags">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port7.png') }}" alt="Custom Backpack Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Corporate Backpack Line</h3>
                                    <p>Professional backpacks with brand visibility</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Bags & Totes</span>
                                        <span class="tag">Backpacks</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 8 -->
                <div class="portfolio-item" data-category="apparel">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port8.png') }}" alt="Custom Hoodie Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Premium Hoodie Collection</h3>
                                    <p>Comfortable hoodies with standout designs</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Apparel</span>
                                        <span class="tag">Hoodies</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 9 -->
                <div class="portfolio-item" data-category="drinkware">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port9.png') }}" alt="Custom Tumbler Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Insulated Tumbler Series</h3>
                                    <p>Temperature-controlled drinkware with style</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Drinkware</span>
                                        <span class="tag">Tumblers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 10 -->
                <div class="portfolio-item" data-category="apparel">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <img src="{{ url('assets/images/port10.png') }}" alt="Custom Cap Design">
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3>Branded Cap Collection</h3>
                                    <p>Stylish headwear that makes a statement</p>
                                    <div class="portfolio-tags">
                                        <span class="tag">Apparel</span>
                                        <span class="tag">Caps</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="portfolio-stats-section">
        <div class="portfolio-container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Merchandise Designs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Product Categories</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Custom Designs</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="portfolio-cta-section">
        <div class="portfolio-container">
            <div class="cta-content">
                <h2>Ready to Start Your Project?</h2>
                <p>Let's collaborate to bring your vision to life with our creative expertise and innovative solutions.</p>
                <div class="cta-buttons">
                    <a href="/marketplace" class="btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Portfolio Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const portfolioItems = document.querySelectorAll('.portfolio-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    portfolioItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Add hover effects to portfolio items
            portfolioItems.forEach(item => {
                const card = item.querySelector('.portfolio-card');
                const overlay = item.querySelector('.portfolio-overlay');

                card.addEventListener('mouseenter', function() {
                    overlay.style.opacity = '1';
                });

                card.addEventListener('mouseleave', function() {
                    overlay.style.opacity = '0';
                });
            });
        });
    </script>
@endsection