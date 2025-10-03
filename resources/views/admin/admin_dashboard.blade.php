@extends('admin/admin_master_view')
@section('file_content')

    <style>
        .hover-shadow {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 1rem;
            border: none;
        }

        .card-body i {
            display: inline-block;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover .card-body i {
            background: #ffffff;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        h5.fw-bold {
            padding: 15px 20px;
            background: #e9ecef;
            border-left: 5px solid #0d6efd;
            border-radius: 5px;
        }

        main.content {
            background: #f4f6f9;
        }

        .card-body h6 {
            margin-top: 10px;
            color: #333;
        }

        .card-body p {
            margin-bottom: 0;
            font-size: 1.25rem;
        }
    </style>

    <main class="content px-3 py-4 bg-light min-vh-100">
        <div class="container-fluid">
            <div class="mb-4">
                <h3 class="fw-bold fs-3 mb-4">
                    Admin Dashboard
                </h3>

                <!-- User Analytics -->
                <div class="row">
                    <h5 class="fw-bold mb-4">Users Analytics</h5>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-people-fill fs-2 text-primary"></i>
                                <h6 class="fw-semibold">Total User</h6>
                                <p class="fw-bold text-secondary">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-person-check-fill fs-2 text-success"></i>
                                <h6 class="fw-semibold">Active User</h6>
                                <p class="fw-bold text-secondary">{{ $stats['active'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-person-dash-fill fs-2 text-danger"></i>
                                <h6 class="fw-semibold">Inactive User</h6>
                                <p class="fw-bold text-secondary">{{ $stats['inactive'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-person-plus-fill fs-2 text-info"></i>
                                <h6 class="fw-semibold">New User Today’s</h6>
                                <p class="fw-bold text-secondary">{{ $stats['new'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Analytics -->
                <div class="row">
                    <h5 class="fw-bold mb-4">Product Analytics</h5>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-phone fs-2 text-primary"></i>
                                <h6 class="fw-semibold">Total Product</h6>
                                <p class="fw-bold text-secondary">{{ $productsList['totalProducts'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-box-seam fs-2 text-success"></i>
                                <h6 class="fw-semibold">In Stock</h6>
                                <p class="fw-bold text-secondary">{{ $productsList['inStock'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-bag-check-fill fs-2 text-danger"></i>
                                <h6 class="fw-semibold">Total Sales</h6>
                                <p class="fw-bold text-secondary">₹{{ number_format($productsList['totalSales']) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-currency-rupee fs-2 text-info"></i>
                                <h6 class="fw-semibold">Today’s Revenue</h6>
                                <p class="fw-bold text-secondary">₹{{ number_format($productsList['todayRevenue']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Order Analytics -->
                <div class="row">
                    <h5 class="fw-bold mb-4">Order Analytics</h5>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-cart fs-2 text-primary"></i>
                                <h6 class="fw-semibold">Total Orders</h6>
                                <p class="fw-bold text-secondary">{{ $orderslist['totalOrders'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-cart-x fs-2 text-success"></i>
                                <h6 class="fw-semibold">Pending Orders</h6>
                                <p class="fw-bold text-secondary">{{ $orderslist['pendingOrders'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-cart-check fs-2 text-danger"></i>
                                <h6 class="fw-semibold">Delivered Orders</h6>
                                <p class="fw-bold text-secondary">{{ $orderslist['deliveredOrders'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-tags fs-2 text-info"></i>
                                <h6 class="fw-semibold">Brands</h6>
                                <p class="fw-bold text-secondary">{{ $orderslist['brandsCount'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Review & Rating Analytics -->
                <div class="row">
                    <h5 class="fw-bold mb-4">Review & Rating Analytics</h5>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-star fs-2 text-primary"></i>
                                <h6 class="fw-semibold">Total Reviews</h6>
                                <p class="fw-bold text-secondary">{{ $reviewstats['totalReviews'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm hover-shadow">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-star fs-2 text-success"></i>
                                <h6 class="fw-semibold">Total Ratings</h6>
                                <p class="fw-bold text-secondary">{{ $reviewstats['totalRatings'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection