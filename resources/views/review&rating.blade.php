@if (!session()->has('user'))
<script>
    window.location.href = "{{ route('login') }}";
</script>
@endif

@extends('master_view')

@section('files')
<div class="container my-5">

    <div class="section-heading-v2">
        <h2>Write a <span class="highlight-green">Product Review</span></h2>
    </div>
    @if (isset($product))
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <div class="review-card-v2">
                <div class="review-product-header">
                    <img src="{{ asset('img/product-images/'.$product->image) }}" alt="Product"
                        class="review-product-image">
                    <div>
                        <p class="text-muted mb-1">You are reviewing:</p>
                        <h5 class="review-product-title">{{ $product->name.' (' .$product->ram.' GB)' }}</h5>
                    </div>
                </div>

                <hr>

                <div class="review-form-body">
                    <form id="review-form" method="post" action="{{ route('review_rating_submit',$product->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Your overall rating</label>
                            <div class="d-flex gap-2" id="starRating">
                                <i class="bi bi-star-fill star" data-value="1"></i>
                                <i class="bi bi-star-fill star" data-value="2"></i>
                                <i class="bi bi-star-fill star" data-value="3"></i>
                                <i class="bi bi-star-fill star" data-value="4"></i>
                                <i class="bi bi-star-fill star" data-value="5"></i>
                            </div>
                            <input type="hidden" id="ratingValue" data-validation="required" name="rating" value="">
                            <div class="error" id="ratingError"></div>
                        </div>

                        <div class="mb-4">
                            <label for="reviewText" class="form-label">Write your review</label>
                            <textarea id="reviewText" class="form-control" rows="5" name="review"
                                placeholder="What did you like or dislike? What did you use this product for?" data-validation="required min max" data-min="10" data-max="100"></textarea>
                            <div class="error" id="reviewError"></div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-submit-review">Submit
                                Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<style>
    /* Main Review Card */
    .review-card-v2 {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    /* Product Header Section */
    .review-product-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
        background-color: #f8f9fa;
    }

    .review-product-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 8px;
    }

    .review-product-title {
        font-weight: 600;
        font-size: 1.3rem;
        margin: 0;
    }

    /* Form Body */
    .review-form-body {
        padding: 30px;
    }

    .review-form-body .form-label {
        font-weight: 500;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .review-form-body .form-control {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        border-radius: 8px;
    }

    .review-form-body .form-control:focus {
        background-color: #fff;
        border-color: var(--primary-green, #3A5A40);
        box-shadow: 0 0 0 0.2rem rgba(58, 90, 64, 0.15);
    }

    /* Star Rating Styles */
    .star {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s, transform 0.2s;
    }

    .star:hover {
        transform: scale(1.1);
    }

    /* UPDATED: Star color now uses the theme's accent gold */
    .star.selected,
    .star.hovered {
        color: var(--accent-gold, #D4AF37);
    }

    /* Submit Button */
    .btn-submit-review {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-submit-review:hover {
        background-color: #2c4431;
        color: white;
        transform: translateY(-2px);
    }

    /* Re-using the beautiful heading style from before */
    .section-heading-v2 {
        display: flex;
        align-items: center;
        margin: 0rem 1rem 2rem 1rem;
    }

    .section-heading-v2::before {
        content: '';
        display: block;
        width: 50px;
        height: 4px;
        background-color: var(--primary-green, #3A5A40);
        border-radius: 2px;
        margin-right: 15px;
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
</style>

<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const val = parseInt(star.getAttribute('data-value'));
            highlightStars(val);
        });

        star.addEventListener('mouseout', () => {
            highlightStars(selectedRating);
        });

        star.addEventListener('click', () => {
            selectedRating = parseInt(star.getAttribute('data-value'));
            ratingInput.value = selectedRating;
            highlightStars(selectedRating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            const val = parseInt(star.getAttribute('data-value'));
            if (val <= rating) {
                star.classList.add(
                    'selected'); // Use 'selected' for clicked, can also add 'hovered' for mouseover
            } else {
                star.classList.remove('selected');
            }
        });
    }
</script>
@endsection