@extends('admin/admin_master_view')

@section('file_content')

    <style>
        /* Table wrapper */
        .table-responsive {
            margin-top: 20px;
        }

        /* Table styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        /* Header row */
        .table thead {
            background: linear-gradient(90deg, #4e73df, #6610f2);
            color: #fff;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 14px;
            border: none;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        /* Body rows */
        .table tbody tr {
            transition: all 0.2s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
            transform: scale(1.01);
        }

        /* ✅ Zebra rows */
        .table tbody tr:nth-child(even) {
            background-color: #fafbfc;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.95rem;
            padding: 12px;
            border-top: 1px solid #dee2e6;
        }

        /* Status badge */
        .badge {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 50px;
        }

        /* Buttons */
        .btn {
            border-radius: 0.5rem !important;
            padding: 6px 12px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn i {
            font-size: 1rem;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        /* ✅ Responsive table (mobile view) */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody td {
                display: block;
                text-align: right;
                border: none;
                position: relative;
                padding-left: 50%;
            }

            .table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: 600;
                text-align: left;
            }
        }
    </style>

    <style>
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

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>🎉 Global Offers</h3>
            <a href="{{ route('add_offer') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Offer
            </a>
        </div>

                <div class="container mt-3">
                    <table id="offerTable" class="table text-center align-middle shadow-sm"
                        style="min-width: 1200px;">
                        <thead class="sticky-top">
                            <tr class="align-middle">
                                <th>Sr. No.</th>
                                <th>Offer Title</th>
                                <th>Code</th>
                                <th>minimum-amount</th>
                                <th>% Off</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($offers))
                                @foreach ($offers as $offer)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $offer->title }}</td>
                                        <td>{{ $offer->code }}</td>
                                        <td>
                                            @if ($offer->min_amount)
                                                {{ number_format($offer->min_amount) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $offer->discount }}%</td>
                                        <td>{{ $offer->start_date }}</td>
                                        <td>{{ $offer->end_date }}</td>
                                        <td>
                                            @if($offer->status === 'active')
                                                <span class="btn btn-success">Active</span>
                                            @else
                                                <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit_offer', $offer->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('offer.destroy', $offer->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this offer?')">
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

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>💰 Product Discounts</h3>
            <a href="{{ route('add_discount') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Discount
            </a>
        </div>

        <div class="table-responsive">
            <table class="table text-center align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Phone</th>
                        <th>M.R.P</th>
                        <th>Discount-type</th>
                        <th>Discount</th>
                        <th>Discounted Price</th>
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
                    @if(isset($discounts))
                        @foreach($discounts as $discount)
                            <tr>
                                <td data-label="Sr. No.">{{ $loop->iteration }}</td>
                                <td data-label="Phone">{{ $discount->product->name }}</td>
                                <td data-label="M.R.P">₹{{ number_format($discount->product->price) }}</td>
                                <td data-label="Discount-type">{{ $discount->discount_type ?? '-' }}</td>
                                <td data-label="Discount">
                                    @if($discount->discount)
                                        {{ $discount->discount_type == 'percentage' ? $discount->discount . '%' : '₹' . number_format($discount->discount) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Discounted Price">
                                    @if ($discount->discount_type)
                                        @if ($discount->discount_type == 'percentage')
                                            {{ number_format($discount->product->price - ($discount->product->price * $discount->discount) / 100) }}
                                        @else
                                            {{ number_format($discount->product->price - $discount->discount) }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Badge-text">
                                    @if ($discount->badge_text)
                                        <span class="badge bg-dark">{{ $discount->badge_text }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Deal-tag">
                                    @if ($discount->deal_tag)
                                        <span class="text-success">{{ $discount->deal_tag }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Feature-highlight">
                                    <span style="font-weight: bold; color: #333;">
                                        {{ $discount->feature_highlight ?? '-' }}
                                    </span>
                                </td>
                                <td data-label="Start Date">{{ $discount->start_date ?? '-' }}</td>
                                <td data-label="End Date">{{ $discount->end_date ?? '-' }}</td>
                                <td data-label="Status">
                                    @if($discount->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td data-label="Action">
                                    <div class="btn-group">
                                        <a href="{{ route('edit_discount', $discount->id) }}" class="btn btn-warning btn-sm me-1"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('discount.destroy', $discount->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this discount?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection