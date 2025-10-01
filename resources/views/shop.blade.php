@extends('master_view')

@section('files')
    <style>
        /* Offer Bar Styles */
        .offer-bar-v2 {
            background-color: var(--primary-green, #3A5A40);
            color: white;
            text-align: center;
            padding: 12px 15px;
            font-size: 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .offer-bar-v2 strong {
            color: var(--accent-gold, #D4AF37);
        }

        /* Sidebar Styles */
        .shop-sidebar-v2 {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .sidebar-title {
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-green, #3A5A40);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-green, #3A5A40);
        }

        /* Accordion Filter Group Styles */
        .filter-group {
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 15px;
            padding-bottom: 15px;
        }

        .filter-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .filter-group-header {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }

        .filter-group-header span {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .filter-caret {
            transition: transform 0.3s ease;
        }

        .filter-group-header[aria-expanded="true"] .filter-caret {
            transform: rotate(-180deg);
        }

        .filter-group-body {
            padding-top: 15px;
        }

        /* Custom Checkbox Styles */
        .custom-checkbox {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 1rem;
            user-select: none;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .custom-checkbox:hover input~.checkmark {
            background-color: #ccc;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: var(--primary-green, #3A5A40);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 6px;
            top: 2px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        /* Form Select (Dropdown) Styling */
        .form-select {
            border-radius: 8px;
        }

        .form-select:focus {
            border-color: var(--primary-green, #3A5A40);
            box-shadow: 0 0 0 0.25rem rgba(58, 90, 64, 0.25);
        }
    </style>

    @if (isset($offer) && $offer->status === 'active')
        <div class="offer-bar-v2 mt-4">
            <i class="bi bi-tag-fill"></i>
            <span>
                <strong>{{ $offer->title }}</strong> : {{ $offer->discount }}% Off <strong>On Order Above</strong>
                {{ number_format($offer->min_amount) }} <strong>Use Code:</strong> {{ $offer->code }}
            </span>
        </div>
    @endif

    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3 mb-5">
                <div class="shop-sidebar-v2">
                    <h4 class="sidebar-title">Shop Filters</h4>

                    <form method="GET" action="{{ route('shop') }}">
                        
                        <div class="filter-group">
                            <div class="filter-group-header">
                                <span>Price</span>
                            </div>
                            <div class="collapse show" id="collapsePrice">
                                <div class="filter-group-body">
                                    @foreach($priceRanges as $value => $label)
                                        <label class="custom-checkbox"> {{ $label }}
                                            <input type="checkbox" name="price[]" value="{{ $value }}"
                                                {{ in_array($value, request()->get('price', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="filter-group">
                            <div class="filter-group-header">
                                <span>Brand</span>
                            </div>
                            <div class="collapse show" id="collapseBrand"> 
                                <div class="filter-group-body">
                                    @foreach($brands as $brand)
                                        <label class="custom-checkbox">
                                            {{ $brand->name }}
                                            <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                                {{ in_array($brand->id, request()->get('brand', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="filter-group">
                            <div class="filter-group-header">
                                <span>Rating</span>
                            </div>
                            <div class="collapse show" id="collapseRating"> 
                                <div class="filter-group-body">
                                    <label class="custom-checkbox"> 4 ★ & above
                                        <input type="checkbox" name="rate[]" value="4"
                                            {{ in_array("4", request()->get('rate', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="custom-checkbox"> 3 ★ & above
                                        <input type="checkbox" name="rate[]" value="3"
                                            {{ in_array("3", request()->get('rate', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="custom-checkbox"> 2 ★ & above
                                        <input type="checkbox" name="rate[]" value="2"
                                            {{ in_array("2", request()->get('rate', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="filter-group">
                            <div class="filter-group-header">
                                <span>RAM</span>
                            </div>
                            <div class="collapse show" id="collapseRam">
                                <div class="filter-group-body">
                                    @foreach($rams as $ram)
                                        <label class="custom-checkbox"> {{ $ram }} GB
                                            <input type="checkbox" name="ram[]" value="{{ $ram }}"
                                                {{ in_array($ram, request()->get('ram', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            <div class="col-lg-9">
                <div class="row g-4">
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
                            <div class="col-12 col-sm-6 col-md-4 fade-in-section">
                                <div class="card product-card-v2 h-100">

                                    @if ($hasActiveDiscount)
                                        @if ($product->badge_text)
                                            <div class="deal-badge-v2">{{ $product->badge_text }}</div>
                                        @endif
                                    @endif

                                    <div class="product-img-wrapper-v2">
                                        <a href="{{ route('phone_details',$product->id) }}">
                                            <img src="{{ asset('img/product-images/' . rawurlencode($product->image)) }}" class="product-img-v2"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </div>

                                    <div class="card-body-v2">
                                        <a href="{{ route('phone_details',$product->id) }}" class="product-title-v2">
                                            {{ $product->name }} ({{ $product->ram }}GB) ({{ $product->storage }}GB)
                                        </a>

                                        <div class="specs-v2 text-muted small mb-1">
                                            @if (!empty($product->ram))
                                                <span><strong>Color</strong>: {{ $product->color }} </span>
                                            @endif
                                        </div>

                                        <div class="specs-v2 text-muted small mb-2">
                                            @if (!empty($product->screen_size))
                                                <span><strong>Display</strong>: {{ $product->screen_size }}</span>
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
                                            <span class="review-count-v2">({{ $product->total_reviews }} reviews)</span>
                                        </div>

                                        <div class="price-wrapper-v2">
                                            @php
                                                    $formatter = new \NumberFormatter('en_IN', \NumberFormatter::DECIMAL);
                                                    $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                                            @endphp
                                            @if ($hasActiveDiscount && $discountedPrice < $product->price)
                                                <span class="current-price-v2">₹{{ $formatter->format($discountedPrice) }}</span>
                                                <span class="original-price-v2">
                                                    M.R.P: <del>₹{{ $formatter->format($product->price) }}</del>
                                                </span>
                                                @if ($product->discount_type === 'percentage')
                                                    <div style="font-size: 14px; font-weight: 600;"> ({{ $formatter->format($product->discount) }}% Off)
                                                    </div>
                                                @elseif ($product->discount_type === 'fixed')
                                                    <div style="font-size: 13px; font-weight: 600;"> (₹{{ $formatter->format($product->discount) }} Off)
                                                    </div>
                                                @endif
                                            @else
                                                <span class="current-price-v2">₹{{ $formatter->format($product->price) }}</span>
                                            @endif
                                        </div>

                                        <div class="specs-v2 text-muted small mb-2 mt-2">
                                            @if (!empty($product->brand_name))
                                                <span><strong>Top Brand</strong>: {{ $product->brand_name }}</span>
                                            @endif
                                        </div>

                                        @if ($product->discount_status === 'active')
                                            <div class="deal-text-v2">{{ $product->deal_tag }}</div>
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

        </div>
    </div>

@endsection