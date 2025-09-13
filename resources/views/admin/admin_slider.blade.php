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

    /* Slider Image */
    .slider-image {
        border-radius: 0.5rem;
        border: 2px solid #e9ecef;
        max-height: 200px;
        max-width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .slider-image:hover {
        transform: scale(1.05);
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

    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .btn-add {
        background: #28a745;
        color: #fff;
        padding: 6px 14px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.3s ease-in-out;
    }

    .btn-add:hover {
        background: #1e7e34;
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
        <h3>🖼️ Slider List</h3>
        <!-- Add Slider Button -->
        <a href="{{ route('add_slider') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Slider
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($sliders)
                @foreach($sliders as $slider)
                <tr>
                    <td data-label="Sr no.">{{ $loop->iteration }}</td>
                    <td data-label="Image">
                        <img src="{{ asset('img/sliders/' . $slider->image) }}" class="slider-image" alt="Slider">
                    </td>
                    <td data-label="Status">
                        @if($slider->status === 'active')
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_slider', $slider->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this slider?')">
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
