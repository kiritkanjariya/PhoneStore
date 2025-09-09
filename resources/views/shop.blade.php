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

    <div class="offer-bar-v2">
        <i class="bi bi-tag-fill"></i>
        <span>
            <strong>Janmastami Offer:</strong> 20% OFF on All Phones! Use Code: <strong>JANMA20</strong>
        </span>
    </div>

    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <div class="shop-sidebar-v2">
                    <h4 class="sidebar-title">Shop Filters</h4>

                    <div class="filter-group">
                        <div class="filter-group-header" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                            <span>Price</span>
                            <i class="bi bi-chevron-down filter-caret"></i>
                        </div>
                        <div class="collapse" id="collapsePrice">
                            <div class="filter-group-body">
                                @foreach($priceRanges as $value => $label)
                                    <label class="custom-checkbox"> {{ $label }}
                                        <input type="checkbox" name="price[]" value="{{ $value }}">
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-header" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                            <span>Brand</span>
                            <i class="bi bi-chevron-down filter-caret"></i>
                        </div>
                        <div class="collapse" id="collapseBrand">
                            <div class="filter-group-body">
                                @foreach($brands as $brand)
                                    <label class="custom-checkbox"> {{ $brand->name }}
                                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-header" data-bs-toggle="collapse" data-bs-target="#collapseRating">
                            <span>Rating</span>
                            <i class="bi bi-chevron-down filter-caret"></i>
                        </div>
                        <div class="collapse" id="collapseRating">
                            <div class="filter-group-body">
                                <label class="custom-checkbox"> 4 ★ & above
                                    <input type="checkbox" name="rate[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-checkbox"> 3 ★ & above
                                    <input type="checkbox" name="rate[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-checkbox"> 2 ★ & above
                                    <input type="checkbox" name="rate[]">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-header" data-bs-toggle="collapse" data-bs-target="#collapseRam">
                            <span>RAM</span>
                            <i class="bi bi-chevron-down filter-caret"></i>
                        </div>
                        <div class="collapse" id="collapseRam">
                            <div class="filter-group-body">
                                @foreach($rams as $ram)
                                    <label class="custom-checkbox"> {{ $ram }} GB
                                        <input type="checkbox" name="ram[]" value="{{ $ram }}">
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="row g-4">

                    <div class="col-12 col-sm-6 col-md-4 fade-in-section">
                        <div class="card product-card-v2 h-100">
                            <div class="deal-badge-v2">17% OFF</div>
                            <div class="product-img-wrapper-v2"><a href="#"><img
                                        src="https://m.media-amazon.com/images/I/71d7rfSl0wL._AC_UY327_FMwebp_QL65_.jpg"
                                        class="product-img-v2" alt="iPhone 15"></a></div>
                            <div class="card-body-v2">
                                <a href="#" class="product-title-v2">Apple iPhone 15, 8GB, 128GB</a>
                                <div class="rating-wrapper-v2">
                                    <div class="rating-stars-v2"><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                                    <span class="review-count-v2">(234 reviews)</span>
                                </div>
                                <div class="price-wrapper-v2"><span class="current-price-v2">₹78,000</span><span
                                        class="original-price-v2">M.R.P: <del>₹90,000</del></span></div>
                                <div class="deal-text-v2">Limited Time Deal</div>
                                <p class="prime-note-v2">Prime Exclusive</p>
                            </div>
                            <div class="card-action-button-v2"><a href="#" class="btn btn-add-to-cart w-100"><i
                                        class="bi bi-cart-fill me-1"></i> Add to Cart</a></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 fade-in-section">
                        <div class="card product-card-v2 h-100">
                            <div class="deal-badge-v2">20% OFF</div>
                            <div class="product-img-wrapper-v2"><a href="#"><img
                                        src="https://cdn.kalvo.com/uploads/img/gallery/70383-vivo-iqoo-z10x-1.jpg"
                                        class="product-img-v2" alt="iQOO Z10x"></a></div>
                            <div class="card-body-v2">
                                <a href="#" class="product-title-v2">iQOO Z10x, 8GB, 256GB</a>
                                <div class="rating-wrapper-v2">
                                    <div class="rating-stars-v2"><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star"></i></div>
                                    <span class="review-count-v2">(178 reviews)</span>
                                </div>
                                <div class="price-wrapper-v2"><span class="current-price-v2">₹16,498</span><span
                                        class="original-price-v2">M.R.P: <del>₹20,499</del></span></div>
                                <div class="deal-text-v2">Special Offer</div>
                                <p class="prime-note-v2">Includes Bank Offer</p>
                            </div>
                            <div class="card-action-button-v2"><a href="#" class="btn btn-add-to-cart w-100"><i
                                        class="bi bi-cart-fill me-1"></i> Add to Cart</a></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 fade-in-section">
                        <div class="card product-card-v2 h-100">
                            <div class="deal-badge-v2">7% OFF</div>
                            <div class="product-img-wrapper-v2"><a href="#"><img
                                        src="https://m.media-amazon.com/images/I/71qGismu6NL._AC_UY327_FMwebp_QL65_.jpg"
                                        class="product-img-v2" alt="Samsung S24 Ultra"></a></div>
                            <div class="card-body-v2">
                                <a href="#" class="product-title-v2">Samsung Galaxy S24 Ultra, 12GB, 256GB</a>
                                <div class="rating-wrapper-v2">
                                    <div class="rating-stars-v2"><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                    <span class="review-count-v2">(510 reviews)</span>
                                </div>
                                <div class="price-wrapper-v2"><span class="current-price-v2">₹70,990</span><span
                                        class="original-price-v2">M.R.P: <del>₹1,39,999</del></span></div>
                                <div class="deal-text-v2">Festive Offer</div>
                                <p class="prime-note-v2">No Cost EMI Available</p>
                            </div>
                            <div class="card-action-button-v2"><a href="#" class="btn btn-add-to-cart w-100"><i
                                        class="bi bi-cart-fill me-1"></i> Add to Cart</a></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const headers = document.querySelectorAll('.filter-group-header');
            headers.forEach(header => {
                header.addEventListener('click', function () {
                    const icon = this.querySelector('.filter-caret');
                    // The aria-expanded attribute is managed by Bootstrap's collapse plugin,
                    // this script just ensures the icon rotates correctly.
                    // A small timeout allows Bootstrap to update the attribute first.
                    setTimeout(() => {
                        if (this.getAttribute('aria-expanded') === 'true') {
                            icon.style.transform = 'rotate(-180deg)';
                        } else {
                            icon.style.transform = 'rotate(0deg)';
                        }
                    }, 250);
                });
            });
        });
    </script>

@endsection