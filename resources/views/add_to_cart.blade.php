@if (!session()->has('user'))
<script>
    window.location.href = "{{ route('login') }}";
</script>
@endif

@extends('master_view')

@section('files')
<div class="container my-5">

    <div class="section-heading-v2">
        <h2>Your Shopping <span class="highlight-green">Cart</span></h2>
    </div>

    <div class="row g-5">
        <!-- Cart Items (Left Column) -->
        <div class="col-lg-8 fade-in-section">
            <div class="cart-items-wrapper">
                <div class="cart-header d-none d-md-flex">
                    <div class="col-md-5">Product</div>
                    <div class="col-md-2 text-center">Price</div>
                    <div class="col-md-3 text-center">Quantity</div>
                    <div class="col-md-2 text-end">Total</div>
                </div>

                @if (isset($carts) && count($carts) > 0)
                @php
                $subtotal = 0;
                @endphp

                @foreach ($carts as $cart)
                @php
                $lineTotal = $cart->product->price * $cart->quantity;
                $subtotal += $lineTotal;
                @endphp

                <div class="cart-item-v2">
                    <div class="product-details">
                        <img src="{{ asset('img/product-images/'.$cart->product->image) }}"
                            class="product-img-v2"
                            alt="{{ $cart->product->name }}">
                        <div>
                            <h5 class="product-title">{{ $cart->product->name }}</h5>
                            <span class="product-meta">Brand : {{ $cart->product->brand->name }}</span>
                        </div>
                    </div>
                    <div class="product-price">₹{{ number_format($cart->product->price) }}</div>
                    <div class="product-quantity">
                        <div class="qty-selector-v2 d-flex align-items-center">
                            <form action="{{ route('decrease_quantity', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit" class="qty-btn">-</button>
                            </form>

                            <div class="px-2">{{ $cart->quantity }}</div>

                            <form action="{{ route('increase_quantity', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="increase">
                                <button type="submit" class="qty-btn">+</button>
                            </form>
                        </div>
                    </div>

                    <div class="product-total">₹{{ number_format($lineTotal) }}</div>
                    <form action="{{ route('delete_cart_item',$cart->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="remove-btn" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
                @endforeach
                @else
                <p>Your cart is empty.</p>
                @endif
            </div>
        </div>

        <div class="col-lg-4 fade-in-section">
            <div class="summary-box-v2">
                <h4 class="summary-title">Cart Summary</h4>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($subtotal ?? 0) }}</span>
                </div>
                <div class="summary-row">
                    <span>Discount</span>
                    <span class="text-success">– ₹200</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>FREE</span>
                </div>
                <hr class="my-3">
                <div class="summary-total">
                    <span>Total</span>
                    <span>₹{{ number_format(($subtotal ?? 0) - 200) }}</span>
                </div>
            </div>
            <div class="d-grid mt-4">
                <a href="{{ route('Checkout') }}" class="btn btn-checkout-v2">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Cart Items Wrapper (Left Column) */
    .cart-items-wrapper {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .cart-header {
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
        margin-bottom: 10px;
    }

    /* Individual Cart Item */
    .cart-item-v2 {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .cart-item-v2:last-child {
        border-bottom: none;
    }

    .product-details {
        flex: 2.5;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-price {
        flex: 1;
        text-align: center;
    }

    .product-quantity {
        flex: 1.5;
        display: flex;
        justify-content: center;
    }

    .product-total {
        flex: 1;
        text-align: right;
        font-weight: 600;
    }

    .product-img-v2 {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .product-meta {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Quantity Selector */
    .qty-selector-v2 {
        display: flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .qty-selector-v2 .qty-btn {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px 12px;
        color: #555;
    }

    .qty-selector-v2 .qty-input {
        width: 40px;
        text-align: center;
        border: none;
        font-weight: 500;
        background: none;
    }

    .qty-selector-v2 .qty-input:focus {
        outline: none;
    }

    /* Remove Button */
    .remove-btn {
        background: none;
        border: none;
        color: #999;
        font-size: 1.2rem;
        cursor: pointer;
        margin-left: 20px;
        transition: color 0.2s ease;
    }

    .remove-btn:hover {
        color: #dc3545;
    }

    /* Summary Box (Right Column) */
    .summary-box-v2 {
        background: #fff;
        border: 1px solid var(--light-green-bg, #E8F5E9);
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .summary-title {
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 20px;
        color: var(--dark-text, #333);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.2rem;
        font-weight: 700;
    }

    /* Checkout Button */
    .btn-checkout-v2 {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-checkout-v2:hover {
        background-color: #2c4431;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Responsive adjustments for mobile */
    @media (max-width: 767px) {
        .cart-item-v2 {
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-details {
            flex-basis: 100%;
            margin-bottom: 15px;
        }

        .product-price,
        .product-total {
            display: none;
        }

        .product-quantity {
            flex-grow: 1;
            justify-content: flex-start;
        }

        .remove-btn {
            margin-left: 0;
        }
    }
</style>
@endsection