@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Brand</h4>
                </div>

                <form action="{{ route('brand_updated') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label for="brand_name" class="form-label fw-semibold">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" data-validation="required" placeholder="Oppo">
                        <div class="error" id="brand_nameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_brand') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Update Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection