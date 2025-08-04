@extends('master_view')

@section('files')
    <div class="forgot-password-container">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">

                <div class="col-lg-6 d-none d-lg-block image-side">
                    <div class="overlay"></div>
                    <div class="brand-content">
                        <h1 class="tagline">Securely Recover Your Account.</h1>
                        <p class="sub-tagline">We'll help you get back on track and into your account safely.</p>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center form-side">
                    <div class="w-100" style="max-width: 450px;">
                        <div class="text-center">
                            <i class="bi bi-shield-lock form-icon"></i>
                            <h3 class="form-title">Forgot Your Password?</h3>
                            <p class="form-subtitle">No problem. Enter your registered email below and we'll send you
                                instructions to reset it.</p>
                        </div>



                        

                        <form action="#/jcjfnj method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="resetEmail" class="form-label">Email address</label>
                                    <input type="text" class="form-control" id="resetEmail" name="resetEmail"
                                        placeholder="you@example.com" data-validation="required email">
                                <div class="error" id="resetEmailError"></div>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-main-form" type="submit">Send Reset Link</button>
                            </div>
                        </form>

                        <p class="text-center back-link-wrapper mt-4">
                            <a href="{{ route('login') }}" class="form-link"><i class="bi bi-arrow-left"></i> Back to
                                Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Main Layout - Reusing styles from login/register for consistency */
        .forgot-password-container {
            background-color: #fff;
        }

        .image-side {
            position: relative;
            background: url('https://images.pexels.com/photos/1786433/pexels-photo-1786433.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') no-repeat center center;
            background-size: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary-green, #3A5A40);
            opacity: 0.8;
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
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 20px;
        }

        .sub-tagline {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 15px;
        }

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

        /* Input Fields */
        .input-group-icon {
            position: relative;
        }

        .input-group-icon .form-control {
            padding-left: 40px;
            height: 50px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .input-group-icon .form-control:focus {
            background-color: #fff;
            border-color: var(--primary-green, #3A5A40);
            box-shadow: 0 0 0 0.25rem rgba(58, 90, 64, 0.15);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* Links */
        .form-link {
            color: var(--primary-green, #3A5A40);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
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
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-main-form:hover {
            background-color: #2c4431;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
