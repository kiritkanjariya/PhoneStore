@extends('admin/admin_master_view')

@section('file_content')


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Service
        <div>
            <a href="{{ route('add_service') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" width="5%" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" width="5%" class="bg-dark text-white">Image</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Service Name</th>
                        <th scope="col" width="50%" class="bg-dark text-white">Description</th>
                        <th scope="col" width="10%" class="bg-dark text-white">Status</th>
                        <th scope="col" width="15%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle text-center">
                        <td>1</td>
                        <td><img src="{{ asset('image/profile.png') }}" height="100px" width="100px"></td>
                        <td>Free Shipping</td>
                        <td>Get free shipping on orders over $50.</td>
                        <td><span class="btn btn-success">Active</span></td>
                        <td>
                            <a href="{{ route('edit_service') }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection