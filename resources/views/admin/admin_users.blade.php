@extends('admin/admin_master_view')
@section('file_content')

<style>
    .card {
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: none;
        background: #ffffff;
    }

    .card-header {
        background: linear-gradient(to right, #0062ff, #00cfff);
        color: #fff !important;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.5rem;
    }

    .table-responsive {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
    }

    .table th {
        vertical-align: middle !important;
        background-color: #212529;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .table td {
        vertical-align: middle !important;
        background-color: #fdfdfd;
    }

    .table tbody tr:hover {
        background-color: #e3f2fd;
        transition: all 0.3s ease;
        transform: scale(1.005);
    }

    .btn {
        border-radius: 0.6rem !important;
        padding: 6px 12px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
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

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    img.img-fluid {
        border-radius: 50%;
        border: 3px solid #dee2e6;
        height: 100px;
        width: 100px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    img.img-fluid:hover {
        transform: scale(1.05);
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
</style>

<div class="card container mt-5 p-4 mb-4">
    <div class="card-header fw-bold d-flex align-items-center justify-content-between">
        Users
        <a href="{{ route('add_user') }}" class="btn-add shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add
        </a>
    </div>

    <div class="table-responsive mt-3" style="z-index: 1;">
        <table id="user" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
            <thead class="sticky-top">
                <tr>
                    <th scope="col">Sr no.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Profile Image</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone no.</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1</td>
                    <td>Kirit</td>
                    <td>
                        <img src="{{ asset('image/profile.png') }}" class="img-fluid">
                    </td>
                    <td>kknajariya630@rku.ac.in</td>
                    <td>6352822005</td>
                    <td>Raiya Road, Rajkot</td>
                    <td>Admin</td>
                    <td><button class="btn btn-success">Active</button></td>
                    <td>23-04-2025</td>
                    <td>
                        <a href="{{ route('edit_user') }}" class="btn btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="align-middle">
                    <td>2</td>
                    <td>Kirit</td>
                    <td>
                        <img src="{{ asset('image/profile.png') }}" class="img-fluid">
                    </td>
                    <td>kknajariya630@rku.ac.in</td>
                    <td>6352822005</td>
                    <td>Raiya Road, Rajkot</td>
                    <td>Admin</td>
                    <td><button class="btn btn-success">Active</button></td>
                    <td>23-04-2025</td>
                    <td>
                        <a href="{{ route('edit_user') }}" class="btn btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
