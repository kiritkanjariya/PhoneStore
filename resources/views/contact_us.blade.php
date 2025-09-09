@extends('master_view')

@section('files')
<style>
    /* Contact Hero Section */
    .contact-hero-v2 {
        position: relative;
        background: url('https://images.unsplash.com/photo-1596524430615-b46475ddff6e?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
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
        opacity: 0.9;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
    }

    /* General Card Styling */
    .contact-info-card,
    .contact-form-card {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    /* Left Column: Info Card */
    .info-card-title,
    .form-card-title {
        font-weight: 700;
        color: var(--dark-text, #333);
        margin-bottom: 10px;
    }

    .info-card-subtitle {
        color: #6c757d;
        margin-bottom: 30px;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        font-size: 1rem;
        color: #555;
    }

    .contact-icon-wrapper {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        background-color: var(--light-green-bg, #E8F5E9);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        color: var(--primary-green, #3A5A40);
        margin-right: 15px;
    }

    .map-container {
        border-radius: 8px;
        overflow: hidden;
        height: 200px;
    }

    .contact-form-card .form-label {
        font-weight: 500;
        margin-bottom: 8px;
    }

    .contact-form-card .form-control {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 12px 15px;
        border-radius: 8px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .contact-form-card .form-control:focus {
        background-color: #fff;
        border-color: var(--primary-green, #3A5A40);
        box-shadow: 0 0 0 0.25rem rgba(58, 90, 64, 0.15);
    }

    .btn-submit-form {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border: none;
        padding: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-submit-form:hover {
        background-color: #2c4431;
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<section class="contact-hero-v2">
    <div class="hero-overlay"></div>
    <div class="container text-center text-white hero-content">
        <h1 class="hero-title">Get In Touch</h1>
        <p class="lead">We'd love to hear from you. Whether you have a question about our products, services, or
            anything else, our team is ready to answer all your questions.</p>
    </div>
</section>

<section class="container py-5">
    <div class="row g-5">

        <div class="col-lg-5 fade-in-section">
            <div class="contact-info-card">
                <h3 class="info-card-title">Contact Information</h3>
                <p class="info-card-subtitle">Fill up the form and our team will get back to you within 24 hours.</p>

                @if (isset($contactInfo))

                <div class="contact-info-item">
                    <div class="contact-icon-wrapper"><i class="bi bi-telephone-fill"></i></div>
                    <span>+91 {{ $contactInfo->phone }}</span>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon-wrapper"><i class="bi bi-envelope-fill"></i></div>
                    <span>{{ $contactInfo->email }}</span>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon-wrapper"><i class="bi bi-geo-alt-fill"></i></div>
                    <span>{{ $contactInfo->location }}</span>
                </div>
                @endif

                <div class="map-container mt-4">
                    <iframe src="https://www.google.com/maps?q=123+Tech+Avenue,+Mumbai,+India&output=embed" width="100%"
                        height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="col-lg-7 fade-in-section">
            <div class="contact-form-card">
                <h3 class="form-card-title">Send Us a Message</h3>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="full_name"
                                placeholder="John Doe" data-validation="required alpha min max" data-min="2"
                                data-max="50">
                            <div class="error" id="full_nameError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@example.com" data-validation="required email">
                            <div class="error" id="emailError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+91 12345 67890"
                            data-validation="required numeric min max" data-min="10" data-max="10">
                        <div class="error" id="phoneError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5"
                            placeholder="Type your message here..." data-validation="required min max" data-min="10"
                            data-max="500"></textarea>
                        <div class="error" id="messageError"></div>
                    </div>

                    <button type="submit" class="btn btn-submit-form w-100">Send Message</button>
                </form>

            </div>
        </div>

    </div>
</section>
@endsection