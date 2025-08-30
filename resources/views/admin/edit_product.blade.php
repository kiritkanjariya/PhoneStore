@extends('admin/admin_master_view')

@section('file_content')


    <div class="card-body row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="container mt-5 mb-5">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Edit Product</h4>
                    </div>

                    @if (isset($products))

                        @foreach ($products as $product)

                        @endforeach
                        <form action="{{ route('product_updated', $product->id) }}" method="POST" enctype="multipart/form-data"
                            class="p-4">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('img/product-images/' . $product->image) }}" class="img-fluid"
                                    style="height: 270px; width: 40%;">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    data-validation="required  min max" data-min="2" data-max="50" value="{{ $product->name }}">
                                <div class="error" id="nameError"></div>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label fw-semibold">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}"
                                    data-validation="required">
                                <div class="error" id="priceError"></div>
                            </div>

                            <div class="mb-3">
                                <label for="brand" class="form-label fw-semibold">Brand</label>
                                <select class="form-select" id="brand" name="brand">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ram" class="form-label fw-semibold">RAM</label>
                                <input type="text" class="form-control" id="ram" name="ram" data-validation="required"
                                    value="{{ $product->ram }}">
                                <div class="error" id="ramError"></div>
                            </div>
                            <div class="mb-4">
                                <label for="storage" class="form-label fw-semibold">Storage</label>
                                <input type="text" class="form-control" id="storage" name="storage"
                                    data-validation="required numeric" value="{{ $product->storage }}">
                                <div class="error" id="storageError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="screen_size" class="form-label fw-semibold">Screen size</label>
                                <input type="text" class="form-control" id="screen_size" name="screen_size"
                                    value="{{ $product->screen_size }}" data-validation="required">
                                <div class="error" id="screen_sizeError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="feature-highlight" class="form-label fw-semibold">Feature-highlight	</label>
                                <input type="text" class="form-control" id="feature_highlight" name="feature_highlight" value="{{ $product->feature_highlight }}">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label fw-semibold">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock"
                                    value="{{ $product->stock_quantity }}" data-validation="required">
                                <div class="error" id="stockError"></div>
                            </div>

                            <div class="mb-4">
                                <label for="product_image" class="form-label fw-semibold">Product Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image"
                                    data-validation="file file1">
                                <div class="error" id="product_imageError"></div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>


                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin_product') }}" class="btn btn-secondary me-2 px-4">Cancel</a>
                                <button type="submit" class="btn btn-success px-4">Update Product</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>


@endsection