@extends('admin/admin_master_view')

@section('file_content')

<style>
    .card {
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border: none;
        background-color: #ffffff;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.5rem;
    }

    .table th {
        vertical-align: middle;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .table td {
        vertical-align: middle;
        background-color: #ffffff;
    }

    .table tbody tr:hover {
        background-color: #1500ffff;
        transition: all 0.3s ease;
        transform: scale(1.01);
    }

    .btn {
        border-radius: 0.5rem !important;
        padding: 6px 12px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn i {
        font-size: 1rem;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .img-fluid {
        border-radius: 0.5rem;
        border: 2px solid #e0e0e0;
        transition: transform 0.3s ease;
    }

    .img-fluid:hover {
        transform: scale(1.05);
    }

    .table th,
    .table td {
        text-align: center;
    }
</style>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between">
        Product
        <div>
            <a href="{{ route('add_product') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="user" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Image</th>
                        <th scope="col" class="bg-dark text-white">Price</th>
                        <th scope="col" class="bg-dark text-white">Brand</th>
                        <th scope="col" class="bg-dark text-white">RAM</th>
                        <th scope="col" class="bg-dark text-white">Storage</th>
                        <th scope="col" class="bg-dark text-white">Screen size</th>
                        <th scope="col" class="bg-dark text-white">Feature-highlight</th>
                        <th scope="col" class="bg-dark text-white">Stock</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($products))
                    @foreach($products as $product)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ asset('img/product-images/' . $product->image) }}" class="img-fluid"
                                style="height: 100px; width: 100px;">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->ram }}</td>
                        <td>{{ $product->storage }}</td>
                        <td>{{ $product->screen_size }}</td>
                        <td>
                            @if ($product->feature_highlight)
                            {{$product->feature_highlight }}
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            @if($product->status === 'active')
                            <span class="btn btn-success">Active</span>
                            @else
                            <span class="btn btn-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('edit_product', $product->id) }}" class="btn btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection