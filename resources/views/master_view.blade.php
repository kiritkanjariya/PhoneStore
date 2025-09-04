<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>NextPhone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('CSS/comman.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('JS/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('JS/validate.js') }}"></script>


</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top px-lg-3 shadow main-nav-v2">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-4 text-white d-flex align-items-center" href="#">
                <img src="{{ asset('img/sliders/NP_Logo-removebg-preview.png') }}" alt="Logo" style="height: 60px;">
                <span>Next<span style="color:#D4AF37">Phone</span></span>
            </a>

            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('service') }}">Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                </ul>

                <form class="d-flex me-3" role="search">
                    <input class="form-control search-input-v2" type="search" placeholder="Search for products..."
                        aria-label="Search" style="width: 300px">
                    <button class="btn btn-search-v2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <div class="d-flex align-items-center header-icons-v2">
                    <a href="{{ route('cart_detail') }}" class="header-icon-link">
                        <i class="bi bi-bag"></i>
                        <span>Cart</span>
                    </a>

                    @if (session()->has('user'))
                    @php
                        $user = session('user');
                    @endphp
                        <div class="dropdown profile-dropdown">
                            <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none"
                                id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $user->profile ? asset('uploads/profile/' . $user->profile) : asset('img/sliders/logo.png') }}"
                                    alt="User Avatar" width="40" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-2 fw-bold text-dark">{{ session('user')->name }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownUser">

                                <li class="dropdown-header text-center">
                                        <h6 class=" mb-0">{{ session('user')->name }}</h6>
                                    <small class="text-muted">{{ session('user')->email }}</small>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-0">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('profile') }}">
                                        <i class="bi bi-person-circle me-2"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('order') }}">
                                        <i class="bi bi-receipt me-2"></i> Order History
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-0">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                        href="{{ route('logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                                </div>
                    @else
                            <a href="{{ route('login') }}" class="header-icon-link">
                                <i class="bi bi-person-circle"></i>
                                <span>Account</span>
                                    </a>
                        @endif
                    </div>


                </div>
            </div>
    </nav>

    {{-- header styles --}}
    <style>
        .main-nav-v2 {
            background-color: var(--primary-green, #3A5A40);
            padding: 0 0;
        }

        /* Animated Underline for Nav Links */
        .main-nav-v2 .nav-link {
            color: #EAEAEA;
            position: relative;
            padding: 8px 0;
            margin: 0 12px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .main-nav-v2 .nav-link:hover,
        .main-nav-v2 .nav-link.active {
            color: #FFFFFF;
        }

        .main-nav-v2 .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--accent-gold, #D4AF37);
            transition: width 0.3s ease;
        }

        .main-nav-v2 .nav-link:hover::after,
        .main-nav-v2 .nav-link.active::after {
            width: 100%;
        }

        /* Refined Search Bar */
        .search-input-v2 {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px 0 0 8px;
            height: 42px;
        }

        .search-input-v2::placeholder {
            color: #cccccc;
        }

        .search-input-v2:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: var(--accent-gold, #D4AF37);
            box-shadow: none;
            color: white;
        }

        .btn-search-v2 {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-left: none;
            color: white;
            border-radius: 0 8px 8px 0;
            height: 42px;
        }

        .btn-search-v2:hover {
            background-color: var(--accent-gold, #D4AF37);
            color: var(--primary-green, #3A5A40);
        }

        /* Interactive Header Icons */
        .header-icons-v2 {
            display: flex;
            gap: 15px;
        }

        .header-icon-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #EAEAEA;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .header-icon-link:hover {
            color: #FFFFFF;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header-icon-link i {
            font-size: 1.4rem;
        }

        .header-icon-link span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Style for mobile toggler icon */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .profile-dropdown {
            background-color: #e5eae5;
            border-radius: 7px;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            border: none;
            padding: 4px 5px;
            margin-left: 15px;


        }

        .profile-dropdown .dropdown-menu {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            border: none;
            padding-top: 0;
            padding-bottom: 0;
        }

        .profile-dropdown .dropdown-item {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            color: #555;
        }

        .profile-dropdown .dropdown-item i {
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .profile-dropdown .dropdown-header {
            padding: 1rem 1.5rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }
    </style>


    @yield('files')


    {{-- footer styles --}}
    <style>
        .footer-v2 {
            background-color: var(--primary-green, #3A5A40);
            color: #EAEAEA;
            /* Soft off-white for text */
            padding-top: 50px;
        }

        .footer-v2 .widget-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #FFFFFF;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-v2 .footer-description {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #cccccc;
            /* Slightly dimmer for description */
        }

        /* Styling for links in the footer */
        .footer-v2 .footer-links a,
        .footer-v2 .contact-info a {
            color: #EAEAEA;
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
            display: block;
            padding: 5px 0;
        }

        .footer-v2 .footer-links a:hover,
        .footer-v2 .contact-info a:hover {
            color: var(--accent-gold, #D4AF37);
            /* Gold color on hover */
            padding-left: 5px;
            /* Slight indent on hover */
        }

        /* Contact info specific styles */
        .footer-v2 .contact-info li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .footer-v2 .contact-info i {
            color: var(--accent-gold, #D4AF37);
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* New Social Icons styles */
        .social-links-v2 {
            display: flex;
            gap: 10px;
        }

        .social-icon-v2 {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #EAEAEA;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon-v2:hover {
            background-color: var(--accent-gold, #D4AF37);
            color: var(--primary-green, #3A5A40);
            border-color: var(--accent-gold, #D4AF37);
            transform: translateY(-3px);
        }

        /* Footer bottom (copyright) section */
        .footer-bottom {
            padding: 20px 0;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.15);
            /* Slightly darker shade of the footer bg */
        }

        .footer-bottom span {
            font-size: 0.9rem;
            color: #cccccc;
        }

        .footer-bottom strong {
            color: #FFFFFF;
            font-weight: 500;
        }
    </style>

    <footer class="footer-v2">
        <div class="container">
            <div class="footer-top-area">
                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="nextphone-logo">
                            <img src=" {{ asset('img/sliders/NP_Logo-removebg-preview.png') }}" alt="Logo"
                            style="height: 80px;">
                            Next<span>Phone</span>
                        </div>
                        <p class="footer-description">
                            NextPhone is where style meets smart technology. Experience powerful performance, sleek
                            design, and reliable innovation—made for your everyday life.
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 mb-4">
                        <h5 class="widget-title">Quick Links</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href=" {{ route('service') }}">Service</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="widget-title">Contact Us</h5>
                        <ul class="list-unstyled contact-info">
                            <li>
                                <i class="bi bi-envelope-fill"></i>
                                <a href="mailto:nextphone@gmail.com">nextphone@gmail.com</a>
                            </li>
                            <li>
                                <i class="bi bi-telephone-fill"></i>
                                <a href="tel:+911234567890">+91 123 456 7890</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="widget-title">Follow Us</h5>
                        <div class="social-links-v2">
                            <a href="#" class="social-icon-v2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon-v2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon-v2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon-v2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-icon-v2"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container text-center">
                <span>© Copyright <strong>NextPhone</strong> 2025-2028. All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <script>
        // SCRIPT FOR NAVBAR SCROLL EFFECT
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // SCRIPT FOR FADE-IN ANIMATION ON SCROLL
        document.addEventListener("DOMContentLoaded", function () {
            const sections = document.querySelectorAll('.fade-in-section');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1 // Triggers when 10% of the element is visible
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            const currentPath = window.location.pathname;

            navLinks.forEach(link => {
                link.classList.remove('active');
                let linkPath = new URL(link.href).pathname;
                if (linkPath === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>