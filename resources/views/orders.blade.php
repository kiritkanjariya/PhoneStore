@if (!session()->has('user'))
<script>
    window.location.href = "{{ route('login') }}";
</script>
@endif

@extends('master_view')

@section('files')
<div class="container my-5">
    <div class="section-heading-v2">
        <h2>My <span class="highlight-green">Orders</span></h2>
    </div>

    <div class="order-card-v2 fade-in-section">
        <div class="order-header">
            <div class="header-col">
                <span class="header-label">ORDER PLACED</span>
                <span class="header-value">21 June 2025</span>
            </div>
            <div class="header-col">
                <span class="header-label">TOTAL</span>
                <span class="header-value">₹1,54,497.00</span>
            </div>
            <div class="header-col text-lg-end">
                <span class="header-label">ORDER # 403-5482167-9565909</span>
            </div>
        </div>

        <div class="order-body">
            <h5 class="delivery-status">Delivered 22 June 2025</h5>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-4 col-md-2">
                    <img src="{{ asset('img/product-images/iphone-15.webp') }}" class="order-product-image" alt="iPhone 15">
                </div>
                <div class="col-8 col-md-6">
                    <a href="#" class="order-product-title">Apple iPhone 15 (128 GB) - Black</a>
                    <p class="text-muted small mb-2">Return window closed on 2 July 2025</p>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end">
                        <button class="btn btn-order-primary"><i class="bi bi-arrow-clockwise me-1"></i> Buy it again</button>
                        <a href="{{ route('review_rating') }}" class="product-review">Write a product review</a>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-4 col-md-2">
                    <img src="{{ asset('img/product-images/iphone-16-5G.webp') }}" class="order-product-image" alt="OnePlus 12">
                </div>
                <div class="col-8 col-md-6">
                    <a href="#" class="order-product-title">OnePlus 12 (Flowy Emerald, 16GB RAM)</a>
                    <p class="text-muted small mb-2">Return window closed on 2 July 2025</p>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end">
                        <button class="btn btn-order-primary"><i class="bi bi-arrow-clockwise me-1"></i> Buy it again</button>
                        <a href="{{ route('review_rating') }}" class="product-review">Write a product review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .order-tabs .nav-link {
        color: #6c757d;
        font-weight: 500;
        border-color: #dee2e6 #dee2e6 #dee2e6;
    }

    .order-tabs .nav-link.active {
        color: var(--primary-green, #3A5A40);
        border-color: var(--primary-green, #3A5A40) var(--primary-green, #3A5A40) #fff;
        border-bottom-width: 2px;
    }

    .order-card-v2 {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        margin-bottom: 25px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .order-card-v2:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .order-header {
        background-color: var(--light-green-bg, #E8F5E9);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-col {
        display: flex;
        flex-direction: column;
    }

    .header-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
    }

    .header-value {
        font-weight: 600;
    }

    .header-link {
        font-size: 0.9rem;
        color: var(--primary-green, #3A5A40);
        font-weight: 500;
        text-decoration: none;
    }

    .header-link:hover {
        text-decoration: underline;
    }

    .order-body {
        padding: 25px;
    }

    .delivery-status {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-green, #3A5A40);
    }

    .order-product-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 8px;
    }

    .order-product-title {
        font-weight: 600;
        color: var(--dark-text, #333);
        text-decoration: none;
        display: block;
        margin-bottom: 5px;
    }

    .order-product-title:hover {
        color: var(--primary-green, #3A5A40);
    }

    .btn-order-primary {
        border-radius: 8px;
        font-weight: 500;
        padding: 8px 15px;
        transition: all 0.2s ease;
        background-color: var(--primary-green, #3A5A40);
        border-color: var(--primary-green, #3A5A40);
        color: white;
    }

    .btn-order-primary:hover {
        background-color: #2c4431;
        border-color: #2c4431;
    }

    .product-review {
        background-color: transparent;
        text-decoration: none;
        color: var(--primary-green, #3A5A40);
        border: 1px solid var(--primary-green, #3A5A40);
        font-weight: 500;
        font-size: 16px;
        padding: 9px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-block;
        text-align: center;
    }

    .product-review:hover {
        background-color: var(--primary-green, #3A5A40);
        color: white;
    }

    @media (max-width: 576px) {
        .order-body {
            padding: 15px;
        }

        .delivery-status {
            font-size: 1rem;
        }

        .order-product-image {
            width: 60px;
            height: 60px;
        }

        .order-product-title {
            font-size: 0.9rem;
        }

        .product-review {
            font-size: 14px;
            padding: 7px;
        }

        .btn-order-primary {
            font-size: 14px;
            padding: 6px 10px;
        }
    }
</style>
@endsection