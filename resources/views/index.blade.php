@extends('master_view')
@section('files')

    <style>
        .section-heading-v2 {
            display: flex;
            align-items: center;
            /* Adjust margin as needed for your layout */
            margin: 2rem 1rem 1.5rem 1rem;
        }

        .section-heading-v2 h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-text, #333);
            margin: 0;
        }

        .section-heading-v2 .highlight-green {
            color: var(--primary-green, #3A5A40);
        }



        .brand-logos-wrapper {
            display: flex;
            justify-content: center;
            /* Aligns items to the center */
            align-items: flex-start;
            /* Aligns items to the top */
            flex-wrap: wrap;
            gap: 70px;
            /* Space between brand items */
            padding: 30px 15px;
            background-color: #fff;
            border-radius: 12px;
        }

        .brand-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease;
        }

        .brand-link:hover {
            transform: translateY(-5px);
            /* Subtle lift effect on hover */
        }

        .brand-logo {
            width: 110px;
            /* Set a fixed width */
            height: 110px;
            /* Set a fixed height */
            border-radius: 50%;
            /* This makes the container circular */
            overflow: hidden;
            /* This hides the parts of the image outside the circle */
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the circle without distortion */
        }

        .brand-name {
            font-weight: 600;
            font-size: 1rem;
            color: var(--dark-text, #333);
        }
    </style>

    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}">
                </button>
            @endforeach
        </div>

        <div class="carousel-inner p-5">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('img/sliders/' . $slider->image) }}" alt="{{ $slider->title ?? 'Slider Image' }}"
                        class="d-block" style="width:100%; height: 500px; object-fit: cover;">
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>


    <div class="container mb-4">

        <div class="section-heading-v2">
            <h2>iPhone <span class="highlight-green">@ Best Deal</span></h2>
        </div>

        <div class="row justify-content-center">

            @forelse ($products as $product)
                @php
                    $today = now()->toDateString();

                    $hasActiveDiscount = $product->discount_status === 'active'
                        && (!$product->start_date || $product->start_date <= $today)
                        && (!$product->end_date || $product->end_date >= $today);

                    $discountedPrice = $product->price;
                    if ($hasActiveDiscount && $product->discount_type === 'percentage') {
                        $discountedPrice -= ($product->price * $product->discount) / 100;
                    } elseif ($hasActiveDiscount && $product->discount_type === 'fixed') {
                        $discountedPrice -= $product->discount;
                    }
                @endphp

                @if ($product->status === 'active')
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 fade-in-section">
                        <div class="card product-card-v2 h-100">

                            @if ($hasActiveDiscount)
                                @if ($product->discount_type === 'percentage')
                                    <div class="deal-badge-v2">{{ number_format($product->discount) }}% Off</div>
                                @elseif ($product->discount_type === 'fixed')
                                    <div class="deal-badge-v2">₹{{ number_format($product->discount) }} Off</div>
                                @endif
                                @if ($product->badge_text)
                                    <div class="deal-badge-v2">{{ $product->badge_text }}</div>
                                @endif
                            @elseif ($product->discount_status == 'inactive')
                                <div class="deal-badge-v2 bg-danger">Sale Ended</div>
                            @endif


                            <div class="product-img-wrapper-v2">
                                <a href="{{ route('phone_details', $product->id) }}">
                                    <img src="{{ asset('img/product-images/' . $product->image) }}" class="product-img-v2"
                                        alt="{{ $product->name }}">
                                </a>
                            </div>

                            <div class="card-body-v2">
                                <a href="{{ route('phone_details', $product->id) }}" class="product-title-v2">
                                    {{ $product->name }}
                                    ({{ $product->ram >= 1024 ? ($product->ram / 1024) . 'GB' : $product->ram . 'GB' }})
                                    ({{ $product->storage >= 1024 ? ($product->storage / 1024) . 'TB' : $product->storage . 'GB' }})
                                </a>


                                <div class="specs-v2 text-muted small mb-1">
                                    @if (!empty($product->ram))
                                        <span><strong>Color</strong>: {{ $product->color }} </span>
                                    @endif
                                </div>

                                <div class="specs-v2 text-muted small mb-2">
                                    @if (!empty($product->screen_size))
                                        <span><strong>Display</strong>: {{ $product->screen_size }}"</span>
                                    @endif
                                </div>

                                <div class="rating-wrapper-v2">
                                    <div class="rating-stars-v2">
                                        @php
                                            $avgRating = $product->avg_rating;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="review-count-v2">({{ $product->total_reviews }} ratings)</span>
                                </div>

                                <div class="price-wrapper-v2">
                                    @if ($hasActiveDiscount && $discountedPrice < $product->price)
                                        <span class="current-price-v2">₹{{ number_format($discountedPrice) }}</span>
                                        <span class="original-price-v2">
                                            M.R.P: <del>₹{{ number_format($product->price) }}</del>
                                        </span>
                                    @else
                                        <span class="current-price-v2">₹{{ number_format($product->price) }}</span>
                                    @endif
                                </div>

                                @if ($product->discount_status === 'active')
                                    <div class="deal-text-v2">{{ $product->deal_tag }}</div>
                                @elseif ($product->discount_status === 'inactive')
                                    <div><span class="text-danger bolder">Sale Ended</span></div>
                                @endif

                                @if ($hasActiveDiscount && $product->discount_feature_highlight)
                                    <p class="prime-note-v2 mt-2">{{ $product->discount_feature_highlight }}</p>
                                @elseif ($product->feature_highlight)
                                    <p class="prime-note-v2 mt-2">{{ $product->feature_highlight }}</p>
                                @endif
                            </div>

                            @if(Session::has('user'))
                                @php
                                    $cartQty = \App\Models\Cart::where('user_id', Session::get('user')->id)
                                        ->where('product_id', $product->id)
                                        ->value('quantity') ?? 0;
                                @endphp

                                @if($product->stock_quantity == 0)
                                    <div class="text-center mb-4">
                                        <span class="text-danger">Currently unavailable </span>
                                    </div>
                                @elseif($cartQty >= $product->stock_quantity)
                                    <div class="card-action-button-v2">
                                        <button class="btn btn-secondary w-100" disabled>Max quantity reached</button>
                                    </div>
                                @else
                                    <div class="card-action-button-v2">
                                        <a href="{{ route('add_cart', $product->id) }}" class="btn btn-add-to-cart w-100">
                                            <i class="bi bi-cart-fill me-1"></i> Add to Cart
                                        </a>
                                    </div>
                                @endif
                            @else
                                @if($product->stock_quantity == 0)
                                    <div class="text-center mb-4">
                                        <span class="text-danger">Currently unavailable </span>
                                    </div>
                                @else
                                    <div class="card-action-button-v2">
                                        <a href="{{ route('cart_detail') }}" class="btn btn-add-to-cart w-100">
                                            <i class="bi bi-cart-fill me-1"></i> Add to Cart
                                        </a>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center">No products found.</p>
            @endforelse

        </div>
    </div>


    <div class="container mb-4">

        <div class="section-heading-v2">
            <h2>New Arrivals <span class="highlight-green">Smart Phones</span></h2>
        </div>

        <div class="row justify-content-center">

            @forelse ($newArrival as $new)
                @php
                    $today = now()->toDateString();

                    $hasActiveDiscount = $new->discount_status === 'active'
                        && (!$new->start_date || $new->start_date <= $today)
                        && (!$new->end_date || $new->end_date >= $today);

                    $discountedPrice = $new->price;
                    if ($hasActiveDiscount && $new->discount_type === 'percentage') {
                        $discountedPrice -= ($new->price * $new->discount) / 100;
                    } elseif ($hasActiveDiscount && $new->discount_type === 'fixed') {
                        $discountedPrice -= $new->discount;
                    }
                @endphp

                @if ($new->status === 'active')
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 fade-in-section">
                        <div class="card product-card-v2 h-100">

                            @if ($hasActiveDiscount)
                                @if ($new->discount_type === 'percentage')
                                    <div class="deal-badge-v2">{{ number_format($new->discount) }}% Off</div>
                                @elseif ($new->discount_type === 'fixed')
                                    <div class="deal-badge-v2">₹{{ number_format($new->discount) }} Off</div>
                                @endif
                                @if ($new->badge_text)
                                    <div class="deal-badge-v2">{{ $new->badge_text }}</div>
                                @endif
                            @elseif ($new->discount_status == 'inactive')
                                <div class="deal-badge-v2 bg-danger">Sale Ended</div>
                            @endif


                            <div class="product-img-wrapper-v2">
                                <a href="{{ route('phone_details', $new->id) }}">
                                    <img src="{{ asset('img/product-images/' . $new->image) }}" class="product-img-v2"
                                        alt="{{ $new->name }}">
                                </a>
                            </div>

                            <div class="card-body-v2">
                                <a href="{{ route('phone_details', $new->id) }}" class="product-title-v2">
                                    {{ $new->name }}
                                    ({{ $new->ram >= 1024 ? ($new->ram / 1024) . 'GB' : $new->ram . 'GB' }})
                                    ({{ $new->storage >= 1024 ? ($new->storage / 1024) . 'TB' : $new->storage . 'GB' }})
                                </a>


                                <div class="specs-v2 text-muted small mb-1">
                                    @if (!empty($new->ram))
                                        <span><strong>Color</strong>: {{ $new->color }} </span>
                                    @endif
                                </div>

                                <div class="specs-v2 text-muted small mb-2">
                                    @if (!empty($new->screen_size))
                                        <span><strong>Display</strong>: {{ $new->screen_size }}"</span>
                                    @endif
                                </div>

                                <div class="rating-wrapper-v2">
                                    <div class="rating-stars-v2">
                                        @php
                                            $avgRating = $new->avg_rating;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="review-count-v2">({{ $new->total_reviews }} ratings)</span>
                                </div>

                                <div class="price-wrapper-v2">
                                    @if ($hasActiveDiscount && $discountedPrice < $new->price)
                                        <span class="current-price-v2">₹{{ number_format($discountedPrice) }}</span>
                                        <span class="original-price-v2">
                                            M.R.P: <del>₹{{ number_format($new->price) }}</del>
                                        </span>
                                    @else
                                        <span class="current-price-v2">₹{{ number_format($new->price) }}</span>
                                    @endif
                                </div>

                                @if ($new->discount_status === 'active')
                                    <div class="deal-text-v2">{{ $new->deal_tag }}</div>
                                @elseif ($new->discount_status === 'inactive')
                                    <div><span class="text-danger bolder">Sale Ended</span></div>
                                @endif

                                @if ($hasActiveDiscount && $new->discount_feature_highlight)
                                    <p class="prime-note-v2 mt-2">{{ $new->discount_feature_highlight }}</p>
                                @elseif ($new->feature_highlight)
                                    <p class="prime-note-v2 mt-2">{{ $new->feature_highlight }}</p>
                                @endif
                            </div>

                            @if(Session::has('user'))
                                @php
                                    $cartQty = \App\Models\Cart::where('user_id', Session::get('user')->id)
                                        ->where('product_id', $new->id)
                                        ->value('quantity') ?? 0;
                                @endphp

                                @if($new->stock_quantity == 0)
                                    <div class="text-center mb-4">
                                        <span class="text-danger">Currently unavailable </span>
                                    </div>
                                @elseif($cartQty >= $new->stock_quantity)
                                    <div class="card-action-button-v2">
                                        <button class="btn btn-secondary w-100" disabled>Max quantity reached</button>
                                    </div>
                                @else
                                    <div class="card-action-button-v2">
                                        <a href="{{ route('add_cart', $new->id) }}" class="btn btn-add-to-cart w-100">
                                            <i class="bi bi-cart-fill me-1"></i> Add to Cart
                                        </a>
                                    </div>
                                @endif
                            @else
                                @if($new->stock_quantity == 0)
                                    <div class="text-center mb-4">
                                        <span class="text-danger">Currently unavailable </span>
                                    </div>
                                @else
                                    <div class="card-action-button-v2">
                                        <a href="{{ route('cart_detail') }}" class="btn btn-add-to-cart w-100">
                                            <i class="bi bi-cart-fill me-1"></i> Add to Cart
                                        </a>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center">No products found.</p>
            @endforelse

        </div>

    </div>

    <div class="container my-5">
        <div class="section-heading-v2">
            <h2>Shop by <span class="highlight-green">Top Brands</span></h2>
        </div>
        <div class="brand-logos-wrapper">
            <a href="#" class="brand-link">
                <div class="brand-logo">
                    <img src="{{ asset('img/product-images/iphone-16-5G.webp') }}" alt="Apple iPhone">
                </div>
                <span class="brand-name">Apple</span>
            </a>

            <a href="#" class="brand-link">
                <div class="brand-logo">
                    <img src="https://m.media-amazon.com/images/I/418mFfRZu-L._AC_.jpg" alt="Samsung Galaxy">
                </div>
                <span class="brand-name">Samsung</span>
            </a>

            <a href="#" class="brand-link">
                <div class="brand-logo">
                    <img src="https://m.media-amazon.com/images/I/41-eyvGzycL._AC_UY327_FMwebp_QL65_.jpg"
                        alt="Google Pixel">
                </div>
                <span class="brand-name">Google</span>
            </a>

            <a href="#" class="brand-link">
                <div class="brand-logo">
                    <img src="https://m.media-amazon.com/images/I/616ZzloUDIL._AC_UY327_FMwebp_QL65_.jpg" alt="OnePlus">
                </div>
                <span class="brand-name">OnePlus</span>
            </a>

            <a href="#" class="brand-link">
                <div class="brand-logo">
                    <img src="https://m.media-amazon.com/images/I/71DsX0zIwRL._AC_UY327_FMwebp_QL65_.jpg" alt="Xiaomi">
                </div>
                <span class="brand-name">Xiaomi</span>
            </a>
        </div>

    </div>
@endsection