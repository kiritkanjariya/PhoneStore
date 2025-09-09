@extends('master_view')

@section('files')
<style>
    /* Hero Section */
    .hero-services-v2 {
        position: relative;
        background: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        padding: 100px 0;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--primary-green, #3A5A40);
        opacity: 0.80;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
    }

    /* General Section Title */
    .section-title-v2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark-text, #333);
    }

    /* Service Card Styles */
    .service-card-v2 {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card-v2:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .service-icon-wrapper {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background-color: var(--light-green-bg, #E8F5E9);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.2rem;
        color: var(--primary-green, #3A5A40);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .service-card-v2:hover .service-icon-wrapper {
        background-color: var(--primary-green, #3A5A40);
        color: #fff;
    }

    .service-title {
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.25rem;
    }

    .service-text {
        color: #6c757d;
        font-size: 0.95rem;
    }

    /* Advantage Section Styles */
    .advantage-icon {
        font-size: 2.5rem;
        color: var(--primary-green, #3A5A40);
        margin-bottom: 15px;
    }

    .advantage-title {
        font-weight: 600;
        font-size: 1.2rem;
    }

    /* CTA Section Styles */
    .cta-v2 {
        /* UPDATED: Changed to light green for contrast */
        background-color: var(--light-green-bg, #E8F5E9);
        text-align: center;
        padding: 60px 20px;
    }

    .cta-title {
        /* UPDATED: Changed to dark text for readability */
        color: var(--dark-text, #333);
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .cta-subtitle {
        /* UPDATED: Changed to a muted dark text */
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 25px;
    }

    /* New button style for light backgrounds */
    .btn-cta-primary {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border: 2px solid var(--primary-green, #3A5A40);
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-cta-primary:hover {
        background-color: #2c4431;
        border-color: #2c4431;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>


<section class="hero-services-v2">
    <div class="hero-overlay"></div>
    <div class="container text-center text-white hero-content">
        <h1 class="hero-title">Your Trusted Tech Partner</h1>
        <p class="lead">From fast, reliable repairs to seamless data transfers and exclusive trade-in offers, we
            provide the expert services you need to stay connected.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-v2">Our Core Services</h2>
            <p class="text-muted">Everything you need for your mobile device, all in one place.</p>
        </div>
        <div class="row g-4 justify-content-center">

            @if (isset($services))
            @foreach ($services as $service)
            <div class="col-lg-4 col-md-6 fade-in-section">
                <div class="service-card-v2">
                    <div class="service-icon-wrapper"><i class="{{ $service->service_icon }}"></i></div>
                    <h5 class="service-title">{{ $service->service_title }}</h5>
                    <p class="service-text">{{ $service->service_description }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="section-title-v2 mb-5">The NextPhone Advantage</h2>
        <div class="row g-4">
            @if (isset($advantages))
            @foreach ($advantages as $advantage)
            <div class="col-md-3 fade-in-section">
                <div class="advantage-item">
                    <div class="advantage-icon"><i class="{{ $advantage->advantage_icon }}"></i></div>
                    <h5 class="advantage-title">{{ $advantage->advanatage_title }}</h5>
                    <p class="text-muted">{{ $advantage->advantage_description }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<section class="cta-v2">
    <div class="container">
        <h2 class="cta-title">Ready to Get Started?</h2>
        <p class="cta-subtitle">Contact our expert team today for a free consultation or quote.</p>
        <a href="#" class="btn btn-cta-primary">Contact Us Now</a>
    </div>
</section>
@endsection