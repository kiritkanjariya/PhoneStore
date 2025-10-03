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

    /* Icon styling */
    .fs-3 {
        font-size: 1.5rem !important;
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

    <!-- ✅ Service Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🛠 Service List</h3>
        <a href="{{ route('add_service') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Service
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Service Name</th>
                    <th>Service Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($services))
                @foreach ($services as $service)
                <tr>
                    <td data-label="Sr no.">{{ $loop->iteration }}</td>
                    <td data-label="Service Name">{{ $service->service_title }}</td>
                    <td data-label="Service Icon"><i class="{{ $service->service_icon }} fs-3 text-primary"></i></td>
                    <td data-label="Description">{{ $service->service_description }}</td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_service', $service->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('delete_service',$service->id) }}" class="btn btn-danger" onclick="return confirm('Delete this Service?')"> <i class="bi bi-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>


    <!-- ✅ Advantage Section -->
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h3>💡 Advantage List</h3>
        <a href="{{ route('add_advantage') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Advantage
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Advantage Title</th>
                    <th>Advantage Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($advantages))
                @foreach ($advantages as $advantage)
                <tr>
                    <td data-label="Sr no.">{{ $loop->iteration }}</td>
                    <td data-label="Advantage Title">{{ $advantage->advantage_title }}</td>
                    <td data-label="Advantage Icon"><i class="{{ $advantage->advantage_icon }} fs-3 text-success"></i></td>
                    <td data-label="Description">{{ $advantage->advantage_description }}</td>
                    <td data-label="Action">
                        <div class="btn-group">
                            <a href="{{ route('edit_advantage', $advantage->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('delete_advantage',$advantage->id) }}" class="btn btn-danger" onclick="return confirm('Delete this advantage?')"> <i class="bi bi-trash"></i></a>
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