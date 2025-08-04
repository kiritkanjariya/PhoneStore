@extends('master_view')

@section('files')
    <div class="container my-5">

        <div class="row g-5">
            <div class="col-lg-6 fade-in-section">
                <div class="product-gallery">
                    <div class="main-image-wrapper">
                        <img src="https://m.media-amazon.com/images/I/61OCxNjjfuL._SX679_.jpg" alt="Product Image"
                            id="main-product-image" class="img-fluid rounded-3">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 fade-in-section">
                <div class="product-details-panel">
                    <h1 class="product-title-v2">Motorola G05 (Forest Green)</h1>
                    <a href="#reviews-section" class="rating-link">
                        <div class="rating-stars-v2">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        </div>
                        <span class="review-count-v2">(491 ratings)</span>
                    </a>

                    <div class="price-block-v2">
                        <span class="current-price-v2">₹46,400</span>
                        <span class="original-price-v2"><del>₹79,900</del></span>
                        <span class="discount-badge">-42%</span>
                    </div>
                    <p class="text-muted"><i class="bi bi-fire text-danger"></i> 200+ bought in past month</p>

                    <ul class="key-features">
                        <li><i class="bi bi-cpu"></i><strong>OS:</strong> Android 14</li>
                        <li><i class="bi bi-sd-card"></i><strong>RAM:</strong> 4 GB</li>
                        <li><i class="bi bi-database"></i><strong>Storage:</strong> 64 GB</li>
                        <li><i class="bi bi-palette"></i><strong>Color:</strong> Forest Green</li>
                        <li><i class="bi bi-display"></i><strong>Display:</strong> 6.1-inch Super Retina XDR</li>
                    </ul>

                    <div class="qty-selector-v2 my-4">
                        <label class="variant-label me-3">Quantity:</label>
                        <button class="qty-btn" onclick="decreaseQty('qty1')">-</button>
                        <input type="text" id="qty1" value="1" class="qty-input">
                        <button class="qty-btn" onclick="increaseQty('qty1')">+</button>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn btn-add-to-cart flex-grow-1"><i
                                class="bi bi-cart-fill me-2"></i>Add to Cart</button>
                        <button type="button" class="btn btn-buy-now flex-grow-1">Buy Now</button>
                    </div>
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
                            <span class="rating-value">4.2</span>
                            <div class="rating-stars-v2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-half"></i></div>
                            <div class="rating-total-text">491 Ratings</div>
                        </div>
                        @php $ratings = [5 => 60, 4 => 20, 3 => 10, 2 => 5, 1 => 5]; @endphp
                        @foreach ($ratings as $star => $percent)
                            <div class="rating-bar-item">
                                <span>{{ $star }} <i class="bi bi-star-fill"></i></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $percent }}%;"></div>
                                </div>
                                <span>{{ $percent }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://i.pravatar.cc/50?u=ravi" class="reviewer-avatar" alt="Ravi">
                            <div>
                                <span class="reviewer-name">Ravi Sharma</span>
                                <div class="rating-stars-v2 small"><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star"></i></div>
                            </div>
                        </div>
                        <p class="review-text">Very good phone for the price. Battery lasts long and display is great.</p>
                        <small class="review-date">Reviewed on July 20, 2025</small>
                    </div>
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://i.pravatar.cc/50?u=priya" class="reviewer-avatar" alt="Priya">
                            <div>
                                <span class="reviewer-name">Priya Desai</span>
                                <div class="rating-stars-v2 small"><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                            </div>
                        </div>
                        <p class="review-text">Camera quality is amazing. Fast delivery. Recommended!</p>
                        <small class="review-date">Reviewed on July 18, 2025</small>
                    </div>
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

    <script>
        function changeImage(element) {
            document.getElementById('main-product-image').src = element.src;
            // Handle active state for thumbnails
            let thumbnails = document.querySelectorAll('.thumbnail-img');
            thumbnails.forEach(thumb => thumb.classList.remove('active'));
            element.classList.add('active');
        }

        function increaseQty(id) {
            const input = document.getElementById(id);
            let value = parseInt(input.value);
            if (!isNaN(value)) input.value = value + 1;
        }

        function decreaseQty(id) {
            const input = document.getElementById(id);
            let value = parseInt(input.value);
            if (!isNaN(value) && value > 1) input.value = value - 1;
        }
    </script>
@endsection
