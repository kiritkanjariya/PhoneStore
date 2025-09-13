@extends('master_view')

@section('files')

<style>
    /* Main container and layout */
    .register-container-v2 {
        background-color: #fff;
    }

    .register-image-side {
        position: relative;
        background: url('https://images.pexels.com/photos/3785424/pexels-photo-3785424.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') no-repeat center center;
        background-size: cover;
    }

    .register-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--primary-green, #3A5A40);
        opacity: 0.85;
    }

    .register-brand-content {
        position: relative;
        z-index: 2;
        color: white;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .register-tagline {
        font-size: 2.5rem;
        font-weight: 700;
        margin-top: 20px;
    }

    .register-sub-tagline {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 15px;
    }

    .register-form-side {
        padding: 40px;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-text, #333);
        margin-bottom: 10px;
    }

    /* Progress Indicator */
    .progress-indicator {
        margin-bottom: 25px;
        font-weight: 500;
        color: var(--primary-green, #3A5A40);
        background-color: var(--light-green-bg, #E8F5E9);
        padding: 8px 12px;
        border-radius: 6px;
        text-align: center;
    }

    /* Multi-step form styles */
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
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
    .register-link {
        color: var(--primary-green, #3A5A40);
        text-decoration: none;
        transition: opacity 0.2s ease;
    }

    .register-link:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    .signup-link-wrapper {
        color: #6c757d;
    }

    /* Buttons */
    .btn-register-v2,
    .btn-secondary {
        border: none;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-register-v2 {
        background-color: var(--primary-green, #3A5A40);
        color: white;
    }

    .btn-register-v2:hover {
        color: white;
        background-color: #2c4431;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: #e9ecef;
        color: #333;
    }

    .btn-secondary:hover {
        color: var(--primary-green, #3A5A40);
        background-color: #dee2e6;
    }
</style>

<div class="register-container-v2">
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">

            <div class="col-lg-6 d-none d-lg-block register-image-side">
                <div class="register-overlay"></div>
                <div class="register-brand-content">
                    <h1 class="register-tagline">Join the NextPhone Family.</h1>
                    <p class="register-sub-tagline">Create an account to unlock exclusive deals, faster checkouts, and
                        personalized support.</p>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center register-form-side">
                <div class="w-100" style="max-width: 500px;">
                    <h3 class="form-title m">Create a New Account</h3>

                    <form action="{{ route('register_submit') }}" id="registration-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Enter your full name"
                                name="fullname" id="full_name" data-validation="required alpha min max" data-min="2"
                                data-max="50" value="Kirit">
                            <div class="error" id="fullnameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email"
                                data-validation="required email" placeholder="Enter your email" value="kkanjariya630@rku.ac.in">
                            <div class="error" id="emailError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                data-validation="required min max numeric" data-max="10" data-min="10"
                                placeholder="Enter your phone number" value="1234567890">
                            <div class="error" id="phoneError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address"
                                data-validation="required min max" data-min="5" data-max="100">R.K.University</textarea>
                            <div class="error" id="addressError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile" name="profile_picture"
                                data-validation="file file1">
                            <div class="error" id="profile_pictureError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password"
                                    data-validation="required strongPassword" placeholder="Create a password" value="KIri23@#">

                                <span class="input-group-text bg-white border-start-0" onclick="togglePassword('password', this)">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="error" id="passwordError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    placeholder="Confirm password" name="c_password"
                                    data-validation="required confirmPassword" data-password-id="password" value="KIri23@#">

                                <span class="input-group-text bg-white border-start-0" onclick="togglePassword('confirm_password', this)">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="error" id="c_passwordError"></div>
                        </div>

                        <style>
                            .input-group-text {
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                            }
                        </style>

                        <script>
                            function togglePassword(inputId, el) {
                                const input = document.getElementById(inputId);
                                const icon = el.querySelector("i");

                                if (input.type === "password") {
                                    input.type = "text";
                                    icon.classList.remove("fa-eye");
                                    icon.classList.add("fa-eye-slash");
                                } else {
                                    input.type = "password";
                                    icon.classList.remove("fa-eye-slash");
                                    icon.classList.add("fa-eye");
                                }
                            }
                        </script>


                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn w-100 btn-register-v2 ms-auto">Register
                            </button>
                        </div>
                    </form>

                    <p class="text-center signup-link-wrapper mt-4">
                        Already have an account? <a href="{{ route('login') }}"
                            class="register-link fw-bold">Login</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection