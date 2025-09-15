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
        /* ✅ Sticky header */
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

    /* ✅ Zebra rows */
    .table tbody tr:nth-child(even) {
        background-color: #fafbfc;
    }

    .table tbody td {
        vertical-align: middle;
        font-size: 0.95rem;
        padding: 12px;
        border-top: 1px solid #dee2e6;
    }

    /* Product Image */
    .img-fluid {
        border-radius: 0.5rem;
        border: 1px solid #e9ecef;
        transition: transform 0.3s ease;
    }

    .img-fluid:hover {
        transform: scale(1.05);
    }

    /* Status & stock badge */
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

    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    /* ✅ Responsive table (mobile view) */
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
        <h3>📦 Product List</h3>
        <!-- ✅ Add Product Button -->
        <a href="{{ route('add_product') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>RAM</th>
                    <th>Storage</th>
                    <th>Color</th>
                    <th>Screen size</th>
                    <th>Feature-highlight</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($products))
                @foreach($products as $product)
                <tr>
                    <td data-label="Sr no.">{{ $loop->iteration }}</td>
                    <td data-label="Name">{{ $product->name }}</td>
                    <td data-label="Image">
                        <img src="{{ asset('img/product-images/' . $product->image) }}" class="img-fluid"
                            style="height: 60px; width: 60px;">
                    </td>

                        <td data-label="Price"><span class="badge bg-primary">₹{{ number_format($product->price, 2) }}</span></td>
                    <td data-label="Brand">{{ $product->brand->name }}</td>
                    <td data-label="RAM">({{ $product->ram >= 1024 ? ($product->ram / 1024) . 'GB' : $product->ram . 'GB' }})</td>
                    <td data-label="Storage">({{ $product->storage >= 1024 ? ($product->storage / 1024) . 'TB' : $product->storage . 'GB' }})</td>
                    <td data-label="Storage">{{ $product->color }}</td>
                    <td data-label="Screen size">{{ $product->screen_size }}"</td>
                    <td data-label="Feature">{{ $product->feature_highlight ?? '-' }}</td>

                    <td data-label="Stock">
                        @if($product->stock_quantity > 20)
                        <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                        @elseif($product->stock_quantity > 0)
                        <span class="badge bg-warning text-dark">{{ $product->stock_quantity }}</span>
                        @else
                        <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </td>
                    <td data-label="Status">
                        @if($product->status === 'active')
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_product', $product->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
