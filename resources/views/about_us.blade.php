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

<!-- Hero Section -->
<section class="about-hero-v2">
    <div class="hero-overlay"></div>
    <div class="container text-center text-white hero-content">
        <h1 class="hero-title">Connecting India to the Future of Mobile</h1>
        <p class="lead">We're more than a retailer; we are your trusted partner in the world of technology.</p>
    </div>
</section>

<!-- About & Mission Section -->
@if (isset($abouts))
    @foreach ($abouts as $about)
        <section class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 fade-in-section">
                    <img src="{{ asset('img/sliders/'.$about->image) }}"
                         alt="A person holding a modern smartphone in a bright, clean environment"
                         class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-6 fade-in-section">
                    <h2 class="section-title-v2">Our Story</h2>
                    <p class="text-muted">{{ $about->about_description }}</p>
                </div>
            </div>
        </section>

        <section class="mission-section">
            <div class="container text-center">
                <h2 class="section-title-v2">Our Mission</h2>
                <p class="lead text-muted mx-auto" style="max-width: 800px;">{{ $about->mission }}</p>
            </div>
        </section>
    @endforeach
@endif

<!-- Why Choose Us Section -->
<section class="container py-5">
    <div class="text-center mb-5">
        <h2 class="section-title-v2">Why <span class="highlight-green">Choose Us?</span></h2>
        <p class="text-muted">We go beyond just selling phones — we create value and long-term relationships.</p>
    </div>
    
    @if (isset($drawbacks))
        <div class="row justify-content-center g-4">
            @foreach ($drawbacks as $drawback)
                <div class="col-lg-4 col-md-6 fade-in-section">
                    <div class="feature-card-v2">
                        <div class="feature-icon-wrapper">
                            <i class="{{ $drawback->drawback_icon }}"></i>
                        </div>
                        <h5 class="feature-title">{{ $drawback->drawback }}</h5>
                        <p class="feature-text">{{ $drawback->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
