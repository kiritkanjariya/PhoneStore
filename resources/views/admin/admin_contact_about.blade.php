@extends('admin/admin_master_view')

@section('file_content')

<style>
    /* General Card Styling */
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .card-header {
        background: linear-gradient(90deg, #4e73df, #6610f2);
        color: #fff;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 0.75rem 0.75rem 0 0;
    }

    /* Form Controls */
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 10px 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, .25);
    }

    /* Buttons */
    .btn {
        border-radius: 0.5rem !important;
        padding: 8px 16px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .btn i {
        font-size: 1rem;
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

    /* Table Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .table thead {
        background: linear-gradient(90deg, #4e73df, #6610f2);
        color: #fff;
    }

    .table thead th {
        padding: 14px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: #f8f9fc;
        transform: scale(1.01);
    }

    .table tbody tr:nth-child(even) {
        background-color: #fafbfc;
    }

    .table tbody td {
        vertical-align: middle;
        font-size: 0.95rem;
        padding: 12px;
        border-top: 1px solid #dee2e6;
    }

    /* Responsive Table */
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

    <!-- Contact Section -->
    <div class="card mb-5">
        <div class="card-header fs-4">📞 Contact Us</div>
        <div class="card-body">
            @if (isset($contactInfo))
            @foreach ($contactInfo as $contact)
            <form action="{{ route('contact_updated') }}" method="POST" class="p-2">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $contact->location }}" placeholder="Enter address" data-validation="required">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $contact->email }}" placeholder="Enter email"
                        data-validation="required email">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold">Phone No.</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $contact->phone }}" placeholder="Enter 10-digit phone number"
                        maxlength="10" minlength="10" data-validation="required numeric">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Update Contact</button>
                </div>
            </form>
            @endforeach
            @endif
        </div>
    </div>


    <!-- About Section -->
    <div class="card mb-5">
        <div class="card-header fs-4">ℹ️ About Us</div>
        <div class="card-body">
            @if (isset($abouts))
            @foreach ($abouts as $about)
            <form action="{{ route('about_updated') }}" method="POST" enctype="multipart/form-data" class="p-2">
                @csrf
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('img/sliders/' . $about->image) }}"
                        class="img-fluid rounded-circle border border-3 border-dark"
                        style="height: 200px; width: 200px; object-fit: cover;">
                </div>

                <div class="mb-3">
                    <label for="about_image" class="form-label fw-semibold">About Image</label>
                    <input type="file" class="form-control" id="about_image" name="about_image">
                </div>

                <div class="mb-3">
                    <label for="about_text" class="form-label fw-semibold">About Us Text</label>
                    <textarea class="form-control" id="about_text" name="about_text" rows="6"
                        placeholder="Enter about us text" data-validation="required">{{ $about->about_description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="mission" class="form-label fw-semibold">Our Mission</label>
                    <textarea class="form-control" id="mission" name="mission" rows="4"
                        placeholder="Enter Our Mission" data-validation="required">{{ $about->mission }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Update About Us</button>
                </div>
            </form>
            @endforeach
            @endif
        </div>
    </div>


    <!-- Drawback Section -->
    <div class="card mb-5">
        <div class="card-header fs-4 d-flex justify-content-between align-items-center">
            ⚠️ Drawback
            <a href="{{ route('add_drawback') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add
            </a>
        </div>
        <div class="table-responsive">
            <table class="table text-center align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($drawbacks))
                    @foreach ($drawbacks as $drawback)
                    <tr>
                        <td data-label="Sr no.">{{ $loop->iteration }}</td>
                        <td data-label="Name">{{ $drawback->drawback }}</td>
                        <td data-label="Icon"><i class="{{ $drawback->drawback_icon }} fs-3 text-primary"></i></td>
                        <td data-label="Description">{{ $drawback->description }}</td>
                        <td data-label="Action">
                            <div class="btn-group">
                                <a href="{{ route('edit_drawback', $drawback->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger shadow">
                                <i class="bi bi-trash"></i>
                            </a>
                            </div>
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
