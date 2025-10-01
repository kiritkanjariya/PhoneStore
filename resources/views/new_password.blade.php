@extends('master_view')

@section('files')
    <div class="otp-container">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">

                <div class="col-lg-6 d-none d-lg-block image-side">
                    <div class="overlay"></div>
                    <div class="brand-content">
                        <h1 class="tagline">Reset Your Password</h1>
                        <p class="sub-tagline">Enter your new password and confirm it below.</p>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center form-side">
                    <div class="w-100" style="max-width: 450px;">
                        <div class="text-center">
                            <h3 class="form-title">Set New Password</h3>
                            <p class="form-subtitle">Please create a strong password and confirm it below.</p>
                        </div>
                        @if (isset($email))
                            <form action="{{ route('reset_password', $email) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password"
                                        placeholder="Enter your password" name="new_password"
                                        data-validation="required strongPassword">
                                    <div class="error" id="new_passwordError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        placeholder="Enter your password" name="confirm_password"
                                        data-validation="required confirmPassword" data-password-id="new_password">
                                    <div class="error" id="confirm_passwordError"></div>
                                </div>

                                <div class="d-grid mb-3">
                                    <button class="btn btn-main-form" type="submit">Update Password</button>
                                </div>
                            </form>
                        @endif

                        <p class="text-center back-link-wrapper mt-3">
                            <a href="{{ route('login') }}" class="form-link"><i class="bi bi-arrow-left"></i> Back to
                                Login</a>
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

        /* Password Inputs */
        .password-input {
            width: 100%;
            height: 55px;
            font-size: 1.1rem;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            background-color: #f8f9fa;
            padding: 0 15px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .password-input:focus {
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