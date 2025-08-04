@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Add Drawback</h4>
                </div>

                <form action="{{ route('drawback_added') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label for="drawback_name" class="form-label fw-semibold">Drawback Name</label>
                        <input type="text" class="form-control" id="drawback_name" name="drawback_name" data-validation="required" placeholder="Enter Drawback Name">
                        <div class="error" id="drawback_nameError"></div>
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
                        <a href="{{ route('admin_contact_about') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Add Drawback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection