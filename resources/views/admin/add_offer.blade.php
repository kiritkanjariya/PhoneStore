@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Offer</h4>
                </div>

                <form action="{{ route('offer_added') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-3">
                        <label for="offer_title" class="form-label fw-semibold">Offer Title</label>
                        <input type="text" class="form-control" id="offer_title" name="offer_title" data-validation="required" placeholder="Enter Offer Title">
                        <div class="error" id="offer_titleError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="offer_code" class="form-label fw-semibold">Offer Code</label>
                        <input type="text" class="form-control" id="offer_code" name="offer_code" placeholder="Enter Offer Code">
                    </div>

                    <div class="mb-4">
                        <label for="min_amount" class="form-label fw-semibold">minimum_amount</label>
                        <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="Enter Offer Code">
                    </div>

                    <div class="mb-3">
                        <label for="discount_percentage" class="form-label fw-semibold">Discount Percentage</label>
                        <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="Enter Discount Percentage" data-validation="required numeric min max" data-min="1" data-max="3">
                        <div class="error" id="discount_percentageError"></div>
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
                        <button type="submit" class="btn btn-success px-4">Add Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection