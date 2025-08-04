@extends('admin/admin_master_view')

@section('file_content')

<style>
    .card {
        border-radius: 1rem;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-header {
        background: linear-gradient(to right, #0dcaf0, #20c997);
        color: #fff;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.5rem;
    }

    .table thead th {
        vertical-align: middle;
        font-size: 0.9rem;
        font-weight: 600;
        background-color: #212529 !important;
        color: #fff !important;
    }

    .table tbody td {
        vertical-align: middle;
        background-color: #fff;
    }

    .table tbody tr:hover {
        background-color: #f0f9ff;
        transition: all 0.3s ease;
        transform: scale(1.01);
    }

    .btn {
        border-radius: 0.5rem;
        font-weight: 600;
    }

    .btn-success {
        background-color: #198754;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }

    .table th,
    .table td {
        text-align: center;
    }
</style>

<!-- Global Offers Section -->
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        Global Offers
        <a href="{{ route('add_offer') }}" class="btn btn-success shadow-none">
            <i class="bi bi-plus-lg"></i> Add
        </a>
    </div>
    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="offerTable" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr class="align-middle">
                        <th>Sr. No.</th>
                        <th>Offer Title</th>
                        <th>Code</th>
                        <th>% Off</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td>1</td>
                        <td>New Year Sale</td>
                        <td>NY2023</td>
                        <td>20%</td>
                        <td>2023-01-01</td>
                        <td>2023-01-31</td>
                        <td><button class="btn btn-success">Active</button></td>
                        <td>
                            <a href="/edit_offer" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Product Discounts Section -->
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        Product Discounts
        <a href="{{ route('add_discount') }}" class="btn btn-success shadow-none">
            <i class="bi bi-plus-lg"></i> Add
        </a>
    </div>
    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="discountTable" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr class="align-middle">
                        <th>Sr. No.</th>
                        <th>Product Name</th>
                        <th>Original Price</th>
                        <th>Discount</th>
                        <th>Discounted Price</th>
                        <th>Discount Label</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td>1</td>
                        <td>Iphone 14 Pro</td>
                        <td>10000</td>
                        <td>20%</td>
                        <td>8000</td>
                        <td><span class="badge bg-success">Limited Time Deal</span></td>
                        <td>2023-01-01</td>
                        <td>2023-01-31</td>
                        <td><button class="btn btn-success">Active</button></td>
                        <td>
                            <a href="{{ route('edit_discount') }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
