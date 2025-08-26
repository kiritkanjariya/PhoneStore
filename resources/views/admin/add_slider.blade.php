@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"> Add Slider</h4>
                </div>

                <form action="{{ route('slider_added') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="slider_image" class="form-label fw-semibold">Image</label>
                        <input type="file" class="form-control" id="slider_image" name="slider_image" data-validation="required file file1">
                        <div class="error" id="slider_imageError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mt-4">
                            <input type="submit" value="Add" class="btn btn-primary">
                            <a href="{{ route('admin_slider') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection