@if (!session()->has('user'))
<script>
    window.location.href = "{{ route('login') }}";
</script>
@endif

@extends('master_view')

@section('files')
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="orders-title">📦 My <span>Orders</span></h2>
        <p class="orders-subtitle">Track, review, and reorder your purchases easily.</p>
    </div>

    @if(isset($orders) && count($orders) > 0)
    @foreach ($orders as $order)
    <div class="order-card glass-card fade-in">
        <div class="order-header">
            <div class="order-info">
                <i class="bi bi-calendar-event"></i>
                <span>Placed: {{ $order->created_at->format('d M Y') }}</span>
            </div>
            <div class="order-info">
                <span>Total: ₹{{ $order->total_amount }}</span>
            </div>
            <div class="order-info">
                <span>Order ID: {{ $order->order_number }}</span>
            </div>
        </div>

        <div class="order-body">
            <div class="delivery-status">
                <i class="bi bi-truck"></i>
                Delivered on {{ $order->delivered_date }}
            </div>
            <hr>

            @php $products = json_decode($order->items, true); @endphp
            @if(!empty($products))
            @foreach($products as $product)
            @php
            $productModel = \App\Models\Products::find($product['product_id']);
            $brands = \App\Models\Products::with('brand')->find($product['product_id']);
            @endphp

            <div class="product-card">
                <div class="product-img">
                    @if($productModel && $productModel->image)
                    <img src="{{ asset('img/product-images/'.$productModel->image) }}" alt="{{ $product['name'] }}">
                    @endif
                </div>
                <div class="product-details">
                    <h5>{{ $product['name'] ?? 'Product' }}</h5>
                    <p>Brand: <strong>{{ $brands->brand->name ?? 'Unknown' }}</strong></p>
                    <p>Quantity: <strong>{{ $product['quantity'] ?? 1 }}</strong></p>
                </div>
                <div class="order-extra mt-3">
                    <p><i class="bi bi-geo-alt"></i> <strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                    <p><i class="bi bi-truck"></i> <strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                </div>

                <div class="product-actions">
                    <button class="btn-order"><i class="bi bi-arrow-repeat"></i> Buy Again</button>

                    @if(!\App\Models\Review::where('product_id', $product['product_id'])
                    ->where('user_id', session('user')->id)
                    ->exists())
                    <a href="{{ route('review_rating', $product['product_id']) }}" class="btn-review">
                        <i class="bi bi-star"></i> Review
                    </a>
                    @endif
                </div>

            </div>
            @endforeach
            @else
            <p class="text-muted">No products in this order.</p>
            @endif
        </div>
    </div>
    @endforeach
    @else
    <div class="text-center">
        <h4>No orders yet 🚫</h4>
        <p>Start shopping and your orders will appear here.</p>
    </div>
    @endif
</div>

<style>
    /* General */
    .orders-title {
        font-weight: 800;
        font-size: 2.4rem;
        color: #222;
    }

    .orders-title span {
        color: #4caf50;
    }

    .orders-subtitle {
        color: #666;
        font-size: 1rem;
    }

    /* Glassmorphism Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        margin-bottom: 35px;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    /* Order Header */
    .order-header {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
        padding: 18px 25px;
        border-bottom: 1px solid #c8e6c9;
    }

    .order-info {
        font-weight: 600;
        color: #2e7d32;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    /* Order Body */
    .order-body {
        padding: 22px;
    }

    .delivery-status {
        font-weight: 700;
        font-size: 1.1rem;
        color: #388e3c;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Product Card */
    .product-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        background: #fff;
        border-radius: 14px;
        padding: 15px 20px;
        margin-bottom: 18px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.02);
    }

    .product-img img {
        width: 85px;
        height: 85px;
        border-radius: 10px;
        object-fit: contain;
        border: 1px solid #ddd;
        background: #fafafa;
        padding: 6px;
    }

    .product-details h5 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #333;
    }

    .product-details p {
        margin: 0;
        font-size: 0.9rem;
        color: #555;
    }

    /* Buttons */
    .btn-order,
    .btn-review {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 16px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-order {
        background: linear-gradient(135deg, #43a047, #2e7d32);
        color: #fff;
        border: none;
    }

    .btn-order:hover {
        background: linear-gradient(135deg, #2e7d32, #43a047);
        transform: translateY(-2px);
    }

    .btn-review {
        border: 2px solid #388e3c;
        color: #388e3c;
        background: transparent;
    }

    .btn-review:hover {
        background: #388e3c;
        color: #fff;
        transform: translateY(-2px);
    }

    /* Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .order-header {
            flex-direction: column;
            gap: 10px;
        }

        .product-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-actions {
            width: 100%;
            display: flex;
            gap: 10px;
        }
    }
</style>
@endsection