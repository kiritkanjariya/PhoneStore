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

                <form action="{{ route('discount_updated') }}" method="POST" class="p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="product_id" class="form-label fw-semibold">Product</label>
                        <select class="form-select" id="product_id" name="product_id" data-validation="required">
                            <option value="iphone14pro">iPhone 14 Pro</option>
                            <option value="samsunggalaxy">Samsung Galaxy</option>
                            <option value="iphone14">iPhone 14</option>
                            <option value="redminote13pro">Redmi Note 13 Pro</option>
                            <option value="realme">Realme</option>
                            <option value="oppo">Oppo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="original_price" class="form-label fw-semibold">Original Price</label>
                        <input type="text" class="form-control" id="original_price" name="original_price" data-validation="required numeric" placeholder="10000">
                        <div class="error" id="original_priceError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="discount_percentage" class="form-label fw-semibold">Discount Percentage</label>
                        <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="20%" data-validation="required numeric min max" data-min="1" data-max="100">
                        <div class="error" id="discount_percentageError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="discounted_price" class="form-label fw-semibold">Discounted Price</label>
                        <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="8000" data-validation="required numeric">
                        <div class="error" id="discounted_priceError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="discount_label" class="form-label fw-semibold">Discount Label</label>
                        <input type="text" class="form-control" id="discount_label" name="discount_label" placeholder="Limited Time Deal" data-validation="required">
                        <div class="error" id="discount_labelError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" data-validation="required">
                        <div class="error" id="start_dateError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" data-validation="required">
                        <div class="error" id="end_dateError"></div>
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
                        <button type="submit" class="btn btn-success px-4">Edit Discount</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection