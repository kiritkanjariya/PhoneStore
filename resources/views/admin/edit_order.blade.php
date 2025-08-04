@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Order</h4>
                </div>

                <form action="{{ route('order_updated') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    <div class="mb-3">
                        <label for="order_id" class="form-label fw-semibold">Order Id</label>
                        <input type="text" class="form-control" id="order_id" name="order_id" data-validation="required min max" data-min="9" data-max="9" placeholder="ORD123456">
                        <div class="error" id="order_idError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="customer_name" class="form-label fw-semibold">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" data-validation="required alpha min max" data-min="2" data-max="50" placeholder="John Doe">
                        <div class="error" id="customer_nameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-semibold">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" data-validation="required" placeholder="Iphone 14 Pro Max">
                        <div class="error" id="product_nameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="total_amount" class="form-label fw-semibold">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="$799" data-validation="required numeric">
                        <div class="error" id="total_amountError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status" data-validation="required">
                            <option value="pending" selected>Pending</option>
                            <option value="completed">Delivered</option>
                        </select>
                        <div class="error" id="statusError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="order_date" class="form-label fw-semibold">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" placeholder="2023-01-01" data-validation="required">
                        <div class="error" id="order_dateError"></div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_order') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection