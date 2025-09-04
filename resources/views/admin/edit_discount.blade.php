@extends('admin/admin_master_view')

@section('file_content')

    <div class="card-body row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="container mt-5 mb-5">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Edit Discount</h4>
                    </div>

                    <form action="{{ route('discount_updated', $discount->id) }}" method="POST" class="p-4">
                        @csrf

                            <div class="mb-3">
                                <label for="product_id" class="form-label fw-semibold">Product</label>
                                <select class="form-select" id="product_id" name="product_id">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" 
                                                data-mrp="{{ $product->price }}"
                                                {{ $discount->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                        <div class="mb-3">
                            <label for="mrp" class="form-label fw-semibold">M.R.P</label>
                            <input type="text" class="form-control" id="original_price_display" value="{{ number_format(optional($discount->product)->price) }}"readonly>
                        </div>

                        <div class="mb-3">
                            <label for="discount_type" class="form-label fw-semibold">Discount-type</label>
                            <select class="form-select" id="discount_type" name="discount_type">
                                <option value="">-- Select Discount Type --</option>
                                <option value="percentage" {{ $discount->discount_type == 'percentage' ? 'selected' : '' }}>
                                    Percentage</option>
                                <option value="fixed" {{ $discount->discount_type == 'fixed' ? 'selected' : '' }}>Fixed
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label fw-semibold">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount"
                                value="{{ $discount->discount }}">
                            @error('discount') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                        <div class="mb-3">
                            <label for="badge-text" class="form-label fw-semibold">Badge-text</label>
                            <input type="text" class="form-control" id="badge_text" name="badge_text"
                                value="{{ $discount->badge_text }}">
                            @error('badge_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deal-tag" class="form-label fw-semibold">Deal-tag</label>
                            <input type="text" class="form-control" id="deal_tag" name="deal_tag"
                                value="{{ $discount->deal_tag }}">
                            @error('deal_tag') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="feature-highlight" class="form-label fw-semibold">Feature-highlight</label>
                            <input type="text" class="form-control" id="feature_highlight" name="feature_highlight"
                                value="{{ $discount->feature_highlight }}">
                            @error('feature_highlight') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label fw-semibold">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ $discount->start_date }}">
                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ $discount->end_date }}">
                            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ $discount->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $discount->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin_offers') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Update Discount</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

@endsection