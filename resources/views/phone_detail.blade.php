@extends('master_view')

@section('files')
    <div class="container my-5">

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

        <div class="row g-5">
            <div class="col-lg-6 fade-in-section">
                <div class="product-gallery">
                    <div class="main-image-wrapper">
                        <img src="{{ asset('img/product-images/' . rawurlencode($product->image)) }}"
                            alt="{{ $product->name }}" id="main-product-image" class="img-fluid rounded-3">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 fade-in-section">
                <div class="product-details-panel">

                    <h1 class="product-title-v2">{{ $product->name }}</h1>
                    @if ($product->badge_text)
                        <h6 style="background-color: #2c4431;
                                                    width: 120px;
                                                    padding: 5px;
                                                    border-radius: 5px;
                                                    color:#fff;">{{ $product->badge_text }}</h6>
                    @endif

                    <a href="#reviews-section" class="rating-link">
                        <div class="rating-stars-v2">
                            @php
                                $avgRating = $reviews->avg('rating');
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                        </div>
                        <span class="review-count-v2">({{ $reviews->count() }} reviews)</span>
                    </a>

                    <div class="price-block-v2">
                        @php
                            $formatter = new \NumberFormatter('en_IN', \NumberFormatter::DECIMAL);
                            $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                        @endphp
                        @if ($hasActiveDiscount && $discountedPrice < $product->price)
                            <span class="current-price-v2">₹{{ $formatter->format($discountedPrice) }}</span>
                            <span class="original-price-v2" style="font-size: 15px;">
                                M.R.P: <del>₹{{ $formatter->format($product->price) }}</del>
                            </span>
                            @if ($product->discount_type === 'percentage')
                                <div style="font-size: 18px; font-weight: 600;"> ({{ $formatter->format($product->discount) }}%
                                    Off)
                                </div>
                            @elseif ($product->discount_type === 'fixed')
                                <div style="font-size: 18px; font-weight: 600;"> (₹{{ $formatter->format($product->discount) }}
                                    Off)
                                </div>
                            @endif
                            <p style="margin-top: 5px; font-size: 12px; font-weight: 600;">
                                {{ $product->discount_feature_highlight }}</p>
                        @else
                            <span class="current-price-v2">₹{{ $formatter->format($product->price) }}</span>
                        @endif
                    </div>

                    <p class="text-muted"><i class="bi bi-fire text-danger"></i> {{ rand(50, 300) }}+ bought in past
                        month
                    </p>

                    <ul class="key-features">
                        <li><i class="bi bi-sd-card"></i><strong>RAM:</strong> {{ $product->ram }} GB</li>
                        <li><i class="bi bi-database"></i><strong>Storage:</strong> {{ $product->storage }} GB</li>
                        <li><i class="bi bi-palette"></i><strong>Color:</strong> {{ $product->color }}</li>
                        <li><i class="bi bi-display"></i><strong>Display:</strong> {{ $product->screen_size }}</li>
                        <li><i class="bi bi-display"></i><strong>Highlight:</strong> {{ $product->feature_highlight }}</li>
                    </ul>

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
                            <div class="action-buttons d-flex gap-2">
                                <a href="{{ route('add_cart', $product->id) }}" class="btn btn-add-to-cart w-25">
                                    <i class="bi bi-cart-fill me-2"></i> Add to Cart
                                </a>
                            </div>
                        @endif
                    @else
                        @if($product->stock_quantity == 0)
                            <div class="text-center mb-4">
                                <span class="text-danger">Currently unavailable </span>
                            </div>
                        @else
                            <div class="action-buttons">
                                <a href="{{ route('cart_detail') }}" class="btn btn-add-to-cart w-25">
                                    <i class="bi bi-cart-fill me-2"></i> Add to Cart
                                </a>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>


        <div id="reviews-section" class="reviews-section-v2 mt-5">
            <div class="section-heading-v2">
                <h2>Customer <span class="highlight-green">Reviews</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="rating-summary">
                        <div class="overall-rating">
                            @php
                                $avgRating = $reviews->avg('rating');
                                $countRating = $reviews->count();
                            @endphp
                            <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                            <div class="rating-stars-v2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <div class="rating-total-text">{{ $countRating }} Ratings</div>
                        </div>

                        @php
                            $ratingsBreakdown = [];
                            foreach (range(1, 5) as $star) {
                                $ratingsBreakdown[$star] = $reviews->where('rating', $star)->count();
                            }
                        @endphp

                        @foreach ($ratingsBreakdown as $star => $count)
                            @php
                                $percent = $countRating > 0 ? ($count / $countRating) * 100 : 0;
                            @endphp
                            <div class="rating-bar-item">
                                <span>{{ $star }} <i class="bi bi-star-fill"></i></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $percent }}%;"></div>
                                </div>
                                <span>{{ round($percent) }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-8">
                    @forelse ($reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <img src="{{asset('uploads/profile/' . $review->user->profile) }}" class="reviewer-avatar"
                                    alt="{{ $review->user->name }}">
                                <div>
                                    <span class="reviewer-name">{{ $review->user->name }}</span>
                                    <div class="rating-stars-v2 small">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="review-text">{{ $review->review }}</p>
                            <small class="review-date">Reviewed on {{ $review->created_at->format('F d, Y') }}</small>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet. Be the first to review this product!</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <style>
        /* Product Gallery */
        .main-image-wrapper {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
        }

        #main-product-image {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: contain;
        }


        /* Product Details Panel */
        .product-details-panel {
            padding: 15px;
        }

        .product-title-v2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .rating-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .rating-stars-v2 {
            color: var(--accent-gold, #D4AF37);
            font-size: 1.1rem;
        }

        .rating-stars-v2.small {
            font-size: 0.9rem;
        }

        .review-count-v2 {
            color: #6c757d;
            font-weight: 500;
        }

        .price-block-v2 {
            background-color: var(--light-green-bg, #E8F5E9);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .current-price-v2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-green, #3A5A40);
        }

        .original-price-v2 {
            color: #6c757d;
            margin-left: 10px;
        }

        .discount-badge {
            background-color: var(--primary-green, #3A5A40);
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 600;
            margin-left: 10px;
        }

        /* REMOVED .variants-section and .variant-label styles as they are no longer needed */

        .key-features {
            list-style: none;
            padding-left: 0;
            margin-bottom: 20px;
        }

        .key-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .key-features i {
            font-size: 1.2rem;
            color: var(--primary-green, #3A5A40);
        }

        .qty-selector-v2 {
            display: flex;
            align-items: center;
        }

        .qty-selector-v2 .variant-label {
            font-weight: 600;
        }

        /* Style for "Quantity:" text */
        .qty-selector-v2 .qty-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            cursor: pointer;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            border-radius: 8px;
        }

        .qty-selector-v2 .qty-input {
            width: 50px;
            text-align: center;
            border: 1px solid #dee2e6;
            height: 40px;
            margin: 0 5px;
            border-radius: 8px;
        }

        .qty-selector-v2 .qty-input:focus {
            outline: none;
            border-color: var(--primary-green, #3A5A40);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-add-to-cart {
            background-color: var(--primary-green, #3A5A40);
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-buy-now {
            background-color: transparent;
            color: var(--primary-green, #3A5A40);
            border: 2px solid var(--primary-green, #3A5A40);
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-add-to-cart:hover {
            background-color: #2c4431;
        }

        .btn-buy-now:hover {
            background-color: var(--primary-green, #3A5A40);
            color: white;
        }

        /* Reviews Section */
        .reviews-section-v2 {
            background-color: var(--light-green-bg, #E8F5E9);
            padding: 40px;
            border-radius: 12px;
        }

        .rating-summary {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .overall-rating {
            margin-bottom: 20px;
        }

        .rating-value {
            font-size: 3rem;
            font-weight: 700;
        }

        .rating-total-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .rating-bar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .rating-bar-item .progress {
            height: 8px;
            flex-grow: 1;
        }

        .rating-bar-item .progress-bar {
            background-color: var(--primary-green, #3A5A40);
        }

        .review-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .reviewer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .reviewer-name {
            font-weight: 600;
        }

        .review-text {
            color: #555;
        }

        .review-date {
            font-size: 0.8rem;
            color: #999;
        }

        .star-rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating-input input {
            display: none;
        }

        .star-rating-input label {
            color: #ccc;
            cursor: pointer;
            font-size: 2rem;
            transition: color 0.2s;
        }

        .star-rating-input input:checked~label,
        .star-rating-input label:hover,
        .star-rating-input label:hover~label {
            color: var(--accent-gold, #D4AF37);
        }
    </style>


@endsection