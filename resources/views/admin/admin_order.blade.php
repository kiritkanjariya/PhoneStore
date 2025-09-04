@extends('admin/admin_master_view')

@section('file_content')


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Orders
    </div>
    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="user" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">Sr. No.</th>
                        <th scope="col" class="bg-dark text-white">Order ID</th>
                        <th scope="col" class="bg-dark text-white">Customer</th>
                        <th scope="col" class="bg-dark text-white">Product(s)</th>
                        <th scope="col" class="bg-dark text-white">Total</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Order Date</th>
                        <th scope="col" class="bg-dark text-white">Delivered Date</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td>1</td>
                        <td>ORD123456</td>
                        <td>John Doe</td>
                        <td>IPhone 13</td>
                        <td>$799</td>
                        <td>Pending</td>
                        <td>12-06-2025</td>
                        <td>15-06-2025</td>
                        <td>
                            <a href="{{ route('edit_order') }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection