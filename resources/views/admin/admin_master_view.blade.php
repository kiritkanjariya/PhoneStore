<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>


    <link rel="stylesheet" href="{{ asset('css/admin_common.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="{{ asset('js/admin_script.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
</head>

<body>
    @if (!session()->has('user'))
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex justify-content-between p-4">
                <div class="sidebar-logo">
                    <a href="{{ route('admin_dashboard') }}" class="text-white fs-5 fw-bold">NextPhone</a>
                </div>
                <button class="toggle-btn border-0" type="button">
                    <i id="icon" class="bi bi-chevron-double-right"></i>
                </button>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item" title="Admin Dashboard">
                    <a href="{{ route('admin_dashboard') }}" class="sidebar-link">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Users">
                    <a href="{{ route('admin_users') }}" class="sidebar-link">
                        <i class="bi bi-person-circle"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Slider">
                    <a href="{{ route('admin_slider') }}" class="sidebar-link">
                        <i class="bi bi-sliders"></i>
                        <span>Slider</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Product">
                    <a href="{{ route('admin_product') }}" class="sidebar-link">
                        <i class="bi bi-box"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Review & Rating">
                    <a href="{{ route('admin_review_rating') }}" class="sidebar-link">
                        <i class="bi bi-star"></i>
                        <span>Review & Rating</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Offers & Discount">
                    <a href="{{ route('admin_offers') }}" class="sidebar-link">
                        <i class="bi bi-gift"></i>
                        <span>Offers</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Orders">
                    <a href="{{ route('admin_order') }}" class="sidebar-link">
                        <i class="bi bi-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Brand">
                    <a href="{{ route('admin_brand') }}" class="sidebar-link">
                        <i class="bi bi-tag"></i>
                        <span>Brand</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Contant & About Us">
                    <a href="{{ route('admin_contact_about') }}" class="sidebar-link">
                        <i class="bi bi-info-circle"></i>
                        <span>Contact & About</span>
                    </a>
                </li>
                <li class="sidebar-item" title="Service">
                    <a href="{{ route('admin_service') }}" class="sidebar-link">
                        <i class="bi bi-tools"></i>
                        <span>Service</span>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main">
            <nav class="top-navbar">
                <a href="{{ route('admin_dashboard') }}" class="navbar-brand-text">Admin Panel</a>

                <div class="d-flex align-items-center gap-3">

                    @if (session()->has('user'))

                    <div class="dropdown">
                        <button class="btn profile-dropdown-btn d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('uploads/profile/'.session('user')->profile ) }}" class="profile-avatar" alt="Admin">
                            <div class="d-none d-sm-block text-start">
                                <div class="profile-name">{{ session('user')->name }}</div>
                                <div class="profile-role">{{ session('user')->email }}</div>
                            </div>
                            <i class="bi bi-chevron-down d-none d-sm-block ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <h6 class="dropdown-header">My Account</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin_profile') }}"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="{{ route('admin_logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                    @endif
                </div>
            </nav>
            <style>
                /* =================================== */
                /* ===== TOP NAVBAR STYLES ===== */
                /* =================================== */
                .top-navbar {
                    background-color: #ffffff;
                    padding: 0.75rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 1px solid #e0e5ec;
                    position: sticky;
                    top: 0;
                    z-index: 1000;
                    box-shadow: 0 6px 12px -3px rgba(33, 37, 41, 0.3);
                }

                .navbar-brand-text {
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #2c3e50;
                    text-decoration: none;
                }

                .profile-dropdown-btn {
                    background: transparent;
                    border: none;
                    padding: 0;
                    min-height: 44px;
                }

                .profile-dropdown-btn:hover {
                    background-color: transparent;
                }

                .profile-avatar {
                    height: 40px;
                    width: 40px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #fff;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                    margin-right: 0.75rem;
                }

                .profile-name {
                    font-weight: 600;
                    color: #2c3e50;
                    font-size: 0.9rem;
                    line-height: 1.2;
                }

                .profile-role {
                    font-size: 0.75rem;
                    color: #95a5a6;
                    line-height: 1.2;
                }

                .dropdown-menu {
                    border-radius: 0.75rem;
                    border: 1px solid #e0e5ec;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    padding: 0.5rem 0;
                    margin-top: 0.5rem !important;
                }

                .dropdown-header {
                    font-weight: 700;
                    padding: 0.75rem 1.25rem;
                    color: #2c3e50;
                }

                .dropdown-item {
                    padding: 0.75rem 1.25rem;
                    font-size: 0.95rem;
                    color: #566a7f;
                    transition: all 0.2s ease-in-out;
                }

                .dropdown-item i {
                    font-size: 1.1rem;
                    margin-right: 0.75rem;
                    width: 20px;
                    text-align: center;
                }

                .dropdown-item:hover,
                .dropdown-item:focus {
                    background-color: #f4f7fc;
                    color: #3b7ddd;
                }

                .dropdown-item:active {
                    background-color: #e9ecef;
                }

                .dropdown-divider {
                    margin: 0.5rem 0;
                    border-top: 1px solid #e0e5ec;
                }
            </style>

            <div class="main-content-scrollable">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @yield('file_content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 admin-footer text-center">
                            <p class="mb-0">© 2023 NextPhone. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>

</html>