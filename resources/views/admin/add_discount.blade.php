@extends('admin/admin_master_view')

@section('file_content')

    <div class="card-body row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="container mt-5 mb-5">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Add Discount</h4>
                    </div>

                    <form action="{{ route('discount_added') }}" method="POST" class="p-4">
                        @csrf

                        @if ($products)
                            <div class="mb-3">
                                <label for="product_id" class="form-label fw-semibold">Product</label>
                                <select class="form-select" id="product_id" name="product_id">
                                    @foreach ($products as $key => $product)
                                        <option value="{{ $product->id }}" data-mrp="{{ $product->price }}" {{ $key === 0 ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="mrp" class="form-label fw-semibold">M.R.P</label>
                            <input type="text" class="form-control" id="original_price_display" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="discount_type" class="form-label fw-semibold">Discount-type</label>
                            <select class="form-select" id="discount_type" name="discount_type">
                                <option value="" disabled selected>-- Select Discount Type --</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label fw-semibold">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount"
                                placeholder="Enter Discount Percentage">
                            @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="badge-text" class="form-label fw-semibold">Badge-text</label>
                            <input type="text" class="form-control" id="badge_text" name="badge_text"
                                placeholder="Enter Discount Label">
                            @error('badge_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deal-tag" class="form-label fw-semibold">Deal-tag</label>
                            <input type="text" class="form-control" id="deal_tag" name="deal_tag"
                                placeholder="Enter Discount Label">
                            @error('deal_tag') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="feature-highlight" class="form-label fw-semibold">Feature-highlight</label>
                            <input type="text" class="form-control" id="feature_highlight" name="feature_highlight"
                                placeholder="Enter Discount Label">
                            @error('feature_highlight') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label fw-semibold">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin_offers') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Add Discount</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const productSelect = document.getElementById('product_id');
        const priceDisplay = document.getElementById('original_price_display');

            function updatePrice() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const mrp = selectedOption.dataset.mrp;

                if (mrp) {
                    priceDisplay.value = '₹' + parseFloat(mrp).toLocaleString('en-IN');
                } else {
                    priceDisplay.value = '';
            }
        }

        productSelect.addEventListener('change', updatePrice);
        updatePrice();
    });
    
    </script>


@endsection