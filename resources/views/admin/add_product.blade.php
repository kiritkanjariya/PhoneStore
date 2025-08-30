@extends('admin/admin_master_view')

@section('file_content')


    <div class="card-body row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="container mt-5 mb-5">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Add Product</h4>
                    </div>

                    <form action="{{ route('product_added') }}" method="POST" enctype="multipart/form-data" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" id="name" name="name" data-validation="required min max"
                                data-min="2" data-max="50" placeholder="Enter Product name">
                            <div class="error" id="nameError"></div>
                        </div>

                        <div class="mb-4">
                            <label for="product_image" class="form-label fw-semibold">Product Image</label>
                            <input type="file" class="form-control" id="product_image" name="product_image"
                                data-validation="required file file1">
                            <div class="error" id="product_imageError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Enter Product Price" data-validation="required">
                            <div class="error" id="priceError"></div>
                        </div>

                        @if(isset($brands))
                            <div class="mb-3">
                                <label for="brand" class="form-label fw-semibold">Brand</label>
                                <select class="form-select" id="brand" name="brand">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="ram" class="form-label fw-semibold">RAM</label>
                            <input type="text" class="form-control" id="ram" name="ram" placeholder="Enter RAM"
                                data-validation="required numeric">
                            <div class="error" id="ramError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="storage" class="form-label fw-semibold">Storage</label>
                            <input type="text" class="form-control" id="storage" name="storage" placeholder="Enter storage"
                                data-validation="required numeric">
                            <div class="error" id="storageError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="screen_size" class="form-label fw-semibold">Screen size</label>
                            <input type="text" class="form-control" id="screen_size" name="screen_size"
                                placeholder="Enter Screen Size" data-validation="required">
                            <div class="error" id="screen_sizeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="feature_highlight" class="form-label fw-semibold">Feature-highlight</label>
                            <input type="text" class="form-control" id="feature_highlight" name="feature_highlight"
                                placeholder="Enter feature_highlight">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label fw-semibold">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter Stock"
                                data-validation="required">
                            <div class="error" id="stockError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin_product') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>


@endsection