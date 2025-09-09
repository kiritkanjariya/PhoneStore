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
                <thead>
                    <tr class="text-center">
                        <th scope="col" width="5%" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Service Name</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Service Icon</th>
                        <th scope="col" width="40%" class="bg-dark text-white">Description</th>
                        <th scope="col" width="15%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($services))
                    @foreach ($services as $service)
                    <tr class="align-middle text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->service_title }}</td>
                        <td><i class="{{ $service->service_icon }}"></i></td>
                        <td>{{ $service->service_description }}</td>
                        <td>
                            <a href="{{ route('edit_service', $service->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Advantage
        <div>
            <a href="{{ route('add_advantage') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col" width="5%" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Advantage Title</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Advantage Icon</th>
                        <th scope="col" width="40%" class="bg-dark text-white">Description</th>
                        <th scope="col" width="15%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($advantages))
                    @foreach ($advantages as $advantage)
                    <tr class="align-middle text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $advantage->advantage_title }}</td>
                        <td><i class="{{ $advantage->advantage_icon }}"></i></td>
                        <td>{{ $advantage->advantage_description }}</td>
                        <td>
                            <a href="{{ route('edit_advantage', $advantage->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection