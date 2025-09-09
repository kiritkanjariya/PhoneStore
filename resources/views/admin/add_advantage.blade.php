@extends('admin/admin_master_view')

@section('file_content')

<div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Add Advantage</h4>
                </div>
                <form action="{{ route('advantage_added') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label for="advantage_title" class="form-label fw-semibold">Advantage Title</label>
                        <input type="text" class="form-control" id="advantage_title" name="advantage_title" data-validation="required" placeholder="Enter Advanatage Title">
                        <div class="error" id="advantage_titleError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="icon" class="form-label fw-semibold">Icon Class</label>
                        <input type="text" class="form-control" id="icon" name="icon" rows="5" data-validation="required" placeholder="Enter Icon class">
                        <div class="error" id="iconError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" data-validation="required" placeholder="Enter Description"></textarea>
                        <div class="error" id="descriptionError"></div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_service') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Add Advantage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection