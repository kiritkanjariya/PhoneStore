@extends('master_view')

@section('files')
<div class="otp-container">
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">

            <!-- Left Side -->
            <div class="col-lg-6 d-none d-lg-block image-side">
                <div class="overlay"></div>
                <div class="brand-content">
                    <h1 class="tagline">Verify Your Identity.</h1>
                    <p class="sub-tagline">Enter the OTP sent to your registered email or mobile number.</p>
                </div>
            </div>

            <!-- OTP Form Side -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center form-side">
                <div class="w-100" style="max-width: 450px;">
                    <div class="text-center">
                        <i class="bi bi-shield-check form-icon"></i>
                        <h3 class="form-title">OTP Verification</h3>
                        <p class="form-subtitle">We’ve sent a 6-digit code to your registered contact. Please enter it below.</p>
                    </div>

                    <form action="{{ route('otp_submit') }}" method="POST">
                        @csrf
                        <div class="mb-4 text-center">
                            <input type="number" name="otp" placeholder="Enter 6-digit OTP" class="otp-single-input">
                            <br>
                            @error('otp')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="error" id="otpError"></div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-main-form" type="submit">Verify OTP</button>
                        </div>
                    </form>

                    <p class="text-center back-link-wrapper mt-3">
                        <a href="{{ route('login') }}" class="form-link"><i class="bi bi-arrow-left"></i> Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Container */
    .otp-container {
        background-color: #fff;
    }

    /* Left Side with Image */
    .image-side {
        position: relative;
        background: url('https://images.pexels.com/photos/5940837/pexels-photo-5940837.jpeg?auto=compress&cs=tinysrgb&w=1600') no-repeat center center;
        background-size: cover;
    }

    .overlay {
        position: absolute;
        inset: 0;
        background-color: var(--primary-green, #3A5A40);
        opacity: 0.85;
    }

    .brand-content {
        position: relative;
        z-index: 2;
        color: white;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .tagline {
        font-size: 2.7rem;
        font-weight: 700;
        margin-top: 20px;
    }

    .sub-tagline {
        font-size: 1.15rem;
        opacity: 0.9;
        margin-top: 15px;
    }

    /* Form */
    .form-side {
        padding: 40px;
    }

    .form-icon {
        font-size: 3rem;
        color: var(--primary-green, #3A5A40);
        margin-bottom: 15px;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-text, #333);
        margin-bottom: 10px;
    }

    .form-subtitle {
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* OTP Single Input */
    .otp-input-wrapper {
        display: flex;
        justify-content: center;
    }

    .otp-single-input {
        width: 100%;
        max-width: 280px;
        height: 60px;
        font-size: 1.4rem;
        text-align: center;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
        font-weight: 600;
        letter-spacing: 5px;
    }

    .otp-single-input:focus {
        outline: none;
        border-color: var(--primary-green, #3A5A40);
        box-shadow: 0 0 8px rgba(58, 90, 64, 0.2);
        background-color: #fff;
    }

    /* Links */
    .form-link {
        color: var(--primary-green, #3A5A40);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: opacity 0.2s ease;
    }

    .form-link:hover {
        opacity: 0.8;
    }

    .back-link-wrapper {
        color: #6c757d;
    }

    .resend-text {
        font-size: 0.95rem;
        color: #6c757d;
    }

    /* Button */
    .btn-main-form {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border: none;
        padding: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-main-form:hover {
        background-color: #2c4431;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection