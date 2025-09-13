@extends('admin/admin_master_view')

@section('file_content')

<style>
    /* Table wrapper */
    .table-responsive {
        margin-top: 20px;
    }

    /* Table styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    /* Header row */
    .table thead {
        background: linear-gradient(90deg, #4e73df, #6610f2);
        color: #fff;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        padding: 14px;
        border: none;
        letter-spacing: 0.5px;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    /* Body rows */
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: #f8f9fc;
        transform: scale(1.01);
    }

    /* Zebra rows */
    .table tbody tr:nth-child(even) {
        background-color: #fafbfc;
    }

    .table tbody td {
        vertical-align: middle;
        font-size: 0.95rem;
        padding: 12px;
        border-top: 1px solid #dee2e6;
    }

    /* Status badge */
    .badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 50px;
    }

    /* Buttons */
    .btn {
        border-radius: 0.5rem !important;
        padding: 6px 12px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn i {
        font-size: 1rem;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    /* Responsive table (mobile view) */
    @media (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table tbody td {
            display: block;
            text-align: right;
            border: none;
            position: relative;
            padding-left: 50%;
        }

        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            font-weight: 600;
            text-align: left;
        }
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📦 Orders</h3>
    </div>

    <div class="table-responsive">
        <table class="table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product(s)</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Delivered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Sr. No.">1</td>
                    <td data-label="Order ID">ORD123456</td>
                    <td data-label="Customer">John Doe</td>
                    <td data-label="Product(s)">IPhone 13</td>
                    <td data-label="Total"><span class="badge bg-primary">$799</span></td>
                    <td data-label="Status"><span class="badge bg-warning text-dark">Pending</span></td>
                    <td data-label="Order Date">12-06-2025</td>
                    <td data-label="Delivered Date">15-06-2025</td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_order') }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td data-label="Sr. No.">2</td>
                    <td data-label="Order ID">ORD654321</td>
                    <td data-label="Customer">Jane Smith</td>
                    <td data-label="Product(s)">Samsung Galaxy S22</td>
                    <td data-label="Total"><span class="badge bg-primary">$699</span></td>
                    <td data-label="Status"><span class="badge bg-success">Delivered</span></td>
                    <td data-label="Order Date">10-06-2025</td>
                    <td data-label="Delivered Date">13-06-2025</td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_order') }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td data-label="Sr. No.">3</td>
                    <td data-label="Order ID">ORD789012</td>
                    <td data-label="Customer">Alice Brown</td>
                    <td data-label="Product(s)">OnePlus 10 Pro</td>
                    <td data-label="Total"><span class="badge bg-primary">$899</span></td>
                    <td data-label="Status"><span class="badge bg-danger">Cancelled</span></td>
                    <td data-label="Order Date">08-06-2025</td>
                    <td data-label="Delivered Date">-</td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_order') }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
