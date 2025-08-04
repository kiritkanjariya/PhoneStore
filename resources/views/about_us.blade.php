@extends('master_view')

@section('files')
    <style>
        /* General Styles */
        .section-title-v2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-text, #333);
        }

        .highlight-green {
            color: var(--primary-green, #3A5A40);
        }

        /* About Us Hero Section */
        .about-hero-v2 {
            position: relative;
            background: url('https://images.unsplash.com/photo-1512428559084-b38f897234c2?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            padding: 80px 0;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary-green, #3A5A40);
            opacity: 0.8;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }


        

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
        }

        /* Mission Section */
        .mission-section {
            background-color: var(--light-green-bg, #E8F5E9);
            padding: 60px 20px;
        }

        /* Feature Card ("Why Choose Us") Styles */
        .feature-card-v2 {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .feature-card-v2:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-green, #3A5A40);
        }

        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background-color: var(--primary-green, #3A5A40);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            color: #fff;
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.25rem;
            color: var(--dark-text, #333);
        }

        .feature-text {
            color: #6c757d;
            font-size: 0.95rem;
        }
    </style>


    <section class="about-hero-v2">
        <div class="hero-overlay"></div>
        <div class="container text-center text-white hero-content">
            <h1 class="hero-title">Connecting India to the Future of Mobile</h1>
            <p class="lead">We're more than a retailer; we are your trusted partner in the world of technology.</p>
        </div>
    </section>

    {{-- <section class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-in-section">
                <img src="https://img.freepik.com/free-vector/mobile-shopping-concept-illustration_114360-1084.jpg"
                    alt="About NextPhone" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 fade-in-section">
                <h2 class="section-title-v2">Our Story</h2>
                <p class="text-muted">
                    Founded in the heart of India's bustling tech scene, <strong class="highlight-green">NextPhone</strong>
                    was born from a simple passion: to make the latest mobile technology accessible to everyone. We saw a
                    gap between high-end devices and everyday users and set out to bridge it with a commitment to fair
                    pricing, transparent service, and genuine products.
                </p>
                <p class="text-muted">
                    Today, we are proud to be a leading destination for smartphone enthusiasts across the country,
                    redefining the mobile shopping experience one customer at a time.
                </p>
            </div>
        </div>
    </section> --}}
    <section class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-in-section">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=2070&auto=format&fit=crop"
                    alt="A person holding a modern smartphone in a bright, clean environment"
                    class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 fade-in-section">
                <h2 class="section-title-v2">Our Story</h2>
                <p class="text-muted">
                    Founded in the heart of India's bustling tech scene, <strong class="highlight-green">NextPhone</strong>
                    was born from a simple passion: to make the latest mobile technology accessible to everyone. We saw a
                    gap between high-end devices and everyday users and set out to bridge it with a commitment to fair
                    pricing, transparent service, and genuine products.
                </p>
                <p class="text-muted">
                    Today, we are proud to be a leading destination for smartphone enthusiasts across the country,
                    redefining the mobile shopping experience one customer at a time.
                </p>
            </div>
        </div>
    </section>

    <section class="mission-section">
        <div class="container text-center">
            <h2 class="section-title-v2">Our Mission</h2>
            <p class="lead text-muted mx-auto" style="max-width: 800px;">
                To empower our customers by providing seamless access to the world's best mobile technology, backed by
                expert support and a commitment to trust, value, and unparalleled service.
            </p>
        </div>
    </section>

    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title-v2">Why <span class="highlight-green">Choose Us?</span></h2>
            <p class="text-muted">We go beyond just selling phones — we create value and long-term relationships.</p>
        </div>
        <div class="row g-4">

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-patch-check-fill"></i></div>
                    <h5 class="feature-title">100% Genuine Products</h5>
                    <p class="feature-text">Every device is sourced directly from manufacturers, ensuring authenticity and a
                        full warranty.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-tags-fill"></i></div>
                    <h5 class="feature-title">Best Price Guarantee</h5>
                    <p class="feature-text">We offer competitive prices and exclusive deals you won’t find anywhere else.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-truck"></i></div>
                    <h5 class="feature-title">Fast & Secure Delivery</h5>
                    <p class="feature-text">Enjoy lightning-fast, insured shipping to get your new device in your hands
                        safely.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-headset"></i></div>
                    <h5 class="feature-title">Expert Tech Support</h5>
                    <p class="feature-text">Our knowledgeable support team is here to assist you with any questions, from
                        setup to troubleshooting.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-arrow-counterclockwise"></i></div>
                    <h5 class="feature-title">Easy & Fair Returns</h5>
                    <p class="feature-text">Shop worry-free with our simple and transparent return policy for a hassle-free
                        experience.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="feature-card-v2">
                    <div class="feature-icon-wrapper"><i class="bi bi-people-fill"></i></div>
                    <h5 class="feature-title">Trusted By Thousands</h5>
                    <p class="feature-text">Join our growing family of happy customers who trust NextPhone for quality and
                        service.</p>
                </div>
            </div>

        </div>
    </section>
@endsection
