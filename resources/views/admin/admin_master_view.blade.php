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
                        <i class="bi bi-speedometer2" ></i>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 px-md-3 py-md-2 px-sm-3 px-sm-2 shadow">
                <div class="navbar-brand">
                    <a href="{{ route('admin_dashboard') }}" class="text-dark fs-5 fw-bold">Admin Panel</a>
                </div>
                <div class="dropdown ms-auto">
                    <button type="button" class="btn dropdown-toggle text-light me-5 p-2" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/sliders/Default-Avatar.jpg') }}" class="rounded-circle" style="height: 40px; width: 40px;" alt="">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin_profile') }}"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>

            <div class="main-content-scrollable">
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