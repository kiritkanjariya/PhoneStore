@extends('admin/admin_master_view')

@section('file_content')

<div class="card-body row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"> Edit Slider</h4>
                </div>

                <form action="{{ route('slider_updated') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf

                     <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/sliders/Oppo-page-banner.jpg') }} " class="img-fluid" style="height: 270px; width: 70%;">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Image</label>
                        <input type="file" class="form-control" id="image" name="image" data-validation="required file file1">
                        <div class="error" id="imageError"></div>
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
                            <input type="submit" value="Update" class="btn btn-primary">
                            <a href="{{ route('admin_slider') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection