@extends('admin/admin_master_view')

@section('file_content')

    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: none;
            background-color: #ffffff;
        }

        .card-header {
            background: linear-gradient(135deg, #1f6feb, #1db954);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1rem 1.5rem;
            font-size: 1.5rem;
        }

        .table th {
            vertical-align: middle !important;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table td {
            vertical-align: middle !important;
            background-color: #fdfdfd;
        }

        .table tbody tr:hover {
            background-color: #f1f9ff;
            transition: all 0.3s ease;
            transform: scale(1.01);
        }

        .btn {
            border-radius: 0.5rem !important;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .btn i {
            font-size: 1rem;
        }

        img.slider-image {
            border-radius: 0.5rem;
            max-width: 100%;
            height: auto;
            border: 3px solid #dee2e6;
            transition: transform 0.3s ease;
        }

        img.slider-image:hover {
            transform: scale(1.02);
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>

    <div class="card container mt-5 p-4 mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span>Slider</span>
            <a href="{{ route('add_slider') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive-lg mt-3" style="z-index: 1;">
            <div class="container">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th width="1%" class="bg-dark text-white">Sr no.</th>
                            <th width="10%" class="bg-dark text-white">Image</th>
                            <th width="2%" class="bg-dark text-white">Status</th>
                            <th width="2%" class="bg-dark text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sliders)
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('img/sliders/' . $slider->image) }}" class="slider-image" height="200px"
                                            width="500px">
                                    </td>
                                    <td>
                                        @if($slider->status === 'active')
                                            <span class="btn btn-success">Active</span>
                                        @else
                                            <span class="btn btn-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_slider') }}" class="btn btn-warning me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this slider?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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