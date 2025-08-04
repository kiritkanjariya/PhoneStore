@extends('admin/admin_master_view')

@section('file_content')

<div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Service</h4>
                </div>
                <form action="{{ route('service_updated') }}" method="POST" class="p-4">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('image/profile.png') }} " class="img-fluid rounded-circle" style="height: 100px; width: 30%;">
                    </div>
                    <div class="mb-4">
                        <label for="service_name" class="form-label fw-semibold">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" data-validation="required" placeholder="Enter Service Name">
                        <div class="error" id="service_nameError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Image</label>
                        <input type="file" class="form-control" id="image" name="image" data-validation="required file file1">
                        <div class="error" id="imageError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" data-validation="required" placeholder="Enter Description"></textarea>
                        <div class="error" id="descriptionError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_service') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection