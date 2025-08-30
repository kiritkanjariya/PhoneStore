@extends('master_view')

@section('files')
    <div class="login-container-v2">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">

                <div class="col-lg-6 d-none d-lg-block login-image-side">
                    <div class="login-overlay"></div>
                    <div class="login-brand-content">
                        <h1 class="login-tagline">Welcome Back to the Future of Mobile.</h1>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center login-form-side">
                    <div class="w-100" style="max-width: 450px;">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h3 class="form-title">Login to Your Account</h3>
                        <p class=" form-subtitle">Enter your credentials to access your profile.</p>
                        <form action="{{ route('loginProcess') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address : </label>
                                <i class="bi bi-lock input-icon"></i>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your Email : " data-validation="required email">
                                <div class="error" id="emailError"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter your password"
                                    name="password" data-validation="required strongPassword">
                                <div class="error" id="passwordError"></div>
                            </div>

                            <div class="text-end mb-4">
                                <a href="{{ route('forgot_pass') }}" class="login-link">Forgot Password?</a>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-login-v2 btn-submit-form">Login</button>
                            </div>
                        </form>

                        <p class="text-center signup-link-wrapper mt-4">
                            Don't have an account? <a href="{{ route('register') }}" class="login-link fw-bold">Sign
                                up</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        .login-container-v2 {
            background-color: #fff;
        }

        /* Left Side: Image & Branding */
        /* CORRECTED CSS with a more stable direct link */
        .login-image-side {
            position: relative;
            background: url('https://images.pexels.com/photos/1786433/pexels-photo-1786433.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') no-repeat center center;
            background-size: cover;
        }

        .login-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary-green, #3A5A40);
            opacity: 0.8;
        }

        .login-brand-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .login-tagline {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 20px;
        }

        /* Right Side: Form */
        .login-form-side {
            padding: 40px;
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

        /* Input Fields with Icons */
        .input-group-icon {
            position: relative;
        }

        .input-group-icon .form-control {
            padding-left: 40px;
            /* Make space for the icon */
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
        .login-link {
            color: var(--primary-green, #3A5A40);
            text-decoration: none;
            font-size: 0.9rem;
            transition: opacity 0.2s ease;
        }

        .login-link:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        .signup-link-wrapper {
            color: #6c757d;
        }

        /* Login Button */
        .btn-login-v2 {
            background-color: var(--primary-green, #3A5A40);
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-login-v2:hover {
            background-color: #2c4431;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection