

@extends('master_view')

@section('files')
    <div class="container py-5">

        <div class="section-heading-v2">
            <h2>Secure <span class="highlight-green">Checkout</span></h2>
        </div>


        <div class="row g-5 mt-4">
            <div class="col-lg-8">
                <div class="checkout-form-panel">
                    <h4 class="mb-4">Shipping Address</h4>
                    <form action="{{ route('Checkoutprocess') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="full_name"
                                    placeholder="Enter your full name" data-validation="required alpha min max" data-min="2"
                                    data-max="50" value="{{ session('user')->name }}">
                                <div class="error" id="full_nameError"></div>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your phone number" data-validation="required numeric min max"
                                    data-min="10" data-max="10" value="{{ session('user')->phone }}">
                                <div class="error" id="phoneError"></div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter your Addresss" data-validation="required min max" data-min="5"
                                    data-max="100" value="{{ session('user')->address }}">
                                <div class="error" id="addressError"></div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-checkout-v2" type="submit">Place Order</button>
                    </form>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="summary-box-v2">
                    <h4 class="summary-title d-flex justify-content-between align-items-center">
                        <span>Your Cart</span>
                        <span class="badge bg-secondary rounded-pill">{{ $carts->count() }}</span>
                    </h4>

                    <ul class="list-unstyled">
                        @php
                            $subtotal = 0;
                        @endphp

                        @foreach ($carts as $cart_item)
                            @php
                                $product = $cart_item->product;
                                $discount = $product->discount ?? null;
                                $price = floatval($product->price ?? 0);
                                $finalPrice = $price;

                                if ($discount && !empty($discount->discount)) {
                                    if ($discount->discount_type === 'percentage') {
                                        $finalPrice = $price - ($price * (float) $discount->discount / 100);
                                    } else {
                                        $finalPrice = $price - (float) $discount->discount;
                                    }
                                }

                                $item_total = $finalPrice * $cart_item->quantity;
                                $subtotal += $item_total;
                            @endphp

                            <li class="summary-product-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/product-images/' . $cart_item->product->image) }}" alt="Product"
                                        width="50" class="me-2">
                                    <div class="item-details">
                                        <h6 class="my-0">{{ $cart_item->product->name }}</h6>
                                        <small class="text-muted">Qty: {{ $cart_item->quantity }}</small>
                                    </div>
                                </div>
                                <span class="text-muted">
                                    ₹{{ number_format($item_total) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <hr class="my-3">

                    @if(Session::has('newTotal'))
                        <div class="summary-total d-flex justify-content-between">
                            <span>Total (INR)</span>
                            <strong>₹{{ number_format(Session::get('newTotal')) }}</strong>
                        </div>
                    @else
                        <div class="summary-total d-flex justify-content-between">
                            <span>Total (INR)</span>
                            <strong>₹{{ number_format($subtotal) }}</strong>
                        </div>
                    @endif

                </div>

                <div style="background-color: #f8f9fa; padding: 8px 10px; margin-top: 10px;">
                    <h6 class="my-3 fw-bold">Coupon code</h6>
                    <form action="{{ route('coupon_apply') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <input class="form-control w-50" type="text" name="code" placeholder="Enter Coupon code" {{ Session::has('newTotal') ? 'disabled' : '' }}>
                            @if(Session::has('newTotal'))
                                <button class="btn" type="button" style="background-color: gray; width: 120px; color: #fff"
                                    disabled>Applied</button>
                            @else
                                <button class="btn" type="submit"
                                    style="background-color: #3A5A40; width: 120px; color: #fff">Apply</button>
                            @endif
                        </div>
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Form & Summary Panels */
        .checkout-form-panel,
        .summary-box-v2 {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }


        /* Summary Box Styles (reusing from cart) */
        .summary-title {
            font-weight: 700;
            color: var(--dark-text, #333);
        }

        .summary-product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-product-item img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 6px;
            margin-right: 15px;
        }

        .summary-product-item .item-details {
            flex-grow: 1;
        }

        .summary-promo-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: var(--primary-green, #3A5A40);
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
        }
    </style>
@endsection