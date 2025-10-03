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

                @if (isset($orders))
                <form action="{{ route('order_updated', $orders->id) }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="order_id" class="form-label fw-semibold">Order Id</label>
                        <input type="text" class="form-control" id="order_id" value="{{ $orders->order_number }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="customer_name" class="form-label fw-semibold">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" value="{{ $orders->user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="total_amount" class="form-label fw-semibold">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" value="{{ $orders->total_amount }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="delivered" {{ $orders->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="pending" {{ $orders->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <div class="error" id="statusError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="order_date" class="form-label fw-semibold">Order Date</label>
                        <input type="text" class="form-control" id="order_date" value="{{ \Carbon\Carbon::parse($orders->created_at)->format('d-m-Y') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="deliverd_date" class="form-label fw-semibold">Delivered Date</label>
                        <input type="date" class="form-control" id="deliverd_date" name="deliverd_date" value="{{ $orders->delivered_date }}">
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_order') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Update Order</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection