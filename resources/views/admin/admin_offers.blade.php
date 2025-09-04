@extends('admin/admin_master_view')

@section('file_content')

    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header {
            background: linear-gradient(to right, #0dcaf0, #20c997);
            color: #fff;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1rem 1.5rem;
            font-size: 1.5rem;
        }

        .table thead th {
            vertical-align: middle;
            font-size: 0.9rem;
            font-weight: 600;
            background-color: #212529 !important;
            color: #fff !important;
        }

        .table tbody td {
            vertical-align: middle;
            background-color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f0f9ff;
            transition: all 0.3s ease;
            transform: scale(1.01);
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: #000;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.5em 0.75em;
            border-radius: 0.5rem;
        }

        .table th,
        .table td {
            text-align: center;
        }
    </style>

    <!-- Global Offers Section -->
    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            Global Offers
            <a href="{{ route('add_offer') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
        <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
            <div class="container mt-3">
                <table id="offerTable" class="table table-striped table-bordered text-center" style="min-width: 1200px;">
                    <thead class="sticky-top">
                        <tr class="align-middle">
                            <th>Sr. No.</th>
                            <th>Offer Title</th>
                            <th>Code</th>
                            <th>% Off</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>1</td>
                            <td>New Year Sale</td>
                            <td>NY2023</td>
                            <td>20%</td>
                            <td>2023-01-01</td>
                            <td>2023-01-31</td>
                            <td><button class="btn btn-success">Active</button></td>
                            <td>
                                <a href="/edit_offer" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            Product Discounts
            <a href="{{ route('add_discount') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>

        <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
            <div class="container mt-3">
                <table id="discountTable" class="table table-striped table-bordered text-center" style="min-width: 1600px;">
                    <thead class="sticky-top">
                        <tr class="align-middle">
                            <th>Sr. No.</th>
                            <th>Phone</th>
                            <th>M.R.P</th>
                            <th>Discount-type</th>
                            <th>Discount</th>
                            <th>Discounted price</th>
                            <th>Badge-text</th>
                            <th>Deal-tag</th>
                            <th>Feature-highlight</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($discounts))
                            @foreach ($discounts as $discount)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $discount->product->name}}</td>
                                    <td>{{ number_format($discount->product->price) }}</td>
                                    <td>
                                        @if ($discount->discount_type)
                                            {{ $discount->discount_type }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($discount->discount)
                                            {{ number_format($discount->discount) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($discount->discount_type)
                                            @if ($discount->discount_type == 'percentage')
                                                @php
                                                    $discountedPrice = $discount->product->price;
                                                @endphp
                                                {{ number_format($discountedPrice -= ($discount->product->price * $discount->discount) / 100) }}
                                            @else
                                                {{ number_format($discount->product->price - $discount->discount) }}
                                            @endif
                                        @else
                                            -    
                                        @endif
                                    </td>
                                    <td>
                                        @if ($discount->badge_text)
                                            <span class="badge" style="
                                                background-color: #3A5A40;
                                                color: white;
                                                padding: 5px 10px;
                                                border-radius: 12px;
                                                font-size: 12px;
                                                font-weight: bold;
                                                display: inline-block;
                                                ">
                                                {{ $discount->badge_text }}
                                        @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if ($discount->deal_tag)
                                            <span style="color: #3A5A40;">
                                                {{ $discount->deal_tag }}
                                        @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span style=" font-weight: bold; color: #333;">
                                            @if ($discount->feature_highlight)
                                                {{ $discount->feature_highlight }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </td>

                                    <td>
                                        @if ($discount->start_date)
                                            {{ $discount->start_date }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($discount->end_date)
                                            {{ $discount->end_date }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($discount->status === 'active')
                                            <span class="btn btn-success">Active</span>
                                        @else
                                            <span class="btn btn-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_discount', $discount->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('discount.destroy', $discount->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this discount?')">
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