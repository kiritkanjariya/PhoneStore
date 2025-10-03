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

    .btn-danger:hover {
        background-color: #c82333;
    }

    .rating-badge {
        background-color: #ffc107;
        color: #000;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 0.5rem;
    }

    .review-text {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="card container mt-5 p-4 mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>Review & Rating</span>
    </div>

    <div class="table-responsive-lg mt-3" style="z-index: 1;">
        <div class="container">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="bg-dark text-white">Sr. No.</th>
                        <th width="15%" class="bg-dark text-white">Product</th>
                        <th width="15%" class="bg-dark text-white">User</th>
                        <th width="10%" class="bg-dark text-white">Rating</th>
                        <th width="30%" class="bg-dark text-white">Review</th>
                        <th width="15%" class="bg-dark text-white">Date</th>
                        <th width="10%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($reviews))
                    @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->Product->name }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>
                            <span class="rating-badge">{{ $review->rating }} ★</span>
                        </td>
                        <td>
                            <span class="review-text" title="Great phone with excellent features!">{{ $review->review }}</span>
                        </td>
                        <td>{{ $review->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a  href="{{ route('delete_review',$review->id) }}" class="btn btn-danger" onclick="return confirm('Delete this review?')"> <i class="bi bi-trash"></i></a>
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