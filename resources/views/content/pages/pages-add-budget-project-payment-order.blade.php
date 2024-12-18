@extends('layouts/contentNavbarLayout')

@section('title', 'Payment Management - Pages')

@section('content')

    <style>
        .limited-scroll {
            max-height: 220px;
            overflow-y: auto;
            display: block;
        }

        .font_style {
            font-weight: bold;
        }

        #error-alert,
        #success-alert {
            transition: opacity 0.5s ease-out;
        }

        /* Adjust the size of the dropdown */
        .form-select {
            font-size: 0.9rem;
            /* Slightly smaller text */
            padding: 8px 12px;
            /* Adjust padding for smaller height */
            border-radius: 4px;
            /* Ensure consistent border radius */
        }

        /* Adjust the size of the buttons */
        .btn {
            font-size: 0.9rem;
            /* Set a smaller font size */
            padding: 6px 12px;
            /* Adjust padding for smaller buttons */
            border-radius: 4px;
            /* Keep a consistent border radius */
        }

        /* Specific button classes for more control */
        .btn-success {
            background-color: #28a745;
            border-color: #218838;
        }

        .btn-primary {
            background-color: #0067aa;
            border-color: #005f8c;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #c82333;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            /* Set the width of the scrollbar */
        }

        ::-webkit-scrollbar-thumb {
            background-color: #0067aa;
            /* Same color as buttons */
            border-radius: 4px;
            /* Rounded corners for the scrollbar thumb */
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #005f8c;
            /* Darker shade when hovered */
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            /* Light background for the track */
            border-radius: 4px;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
            <!-- <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> -->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            <!-- <button type="button" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> -->
            {{ session('success') }}
        </div>
    @endif

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Payment Management /</span> Create Payment Order
    </h4>

    <div class="row">
        <div class="col-md-12">

            <!-- Alert Box -->
            <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert"
                style="display: none; width:80%; margin:10px auto">
                <span id="alertMessage"></span>
                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>

            <!-- Payment Order Form -->
            <div class="card">
                <div class="card-body">
                    <h6>Create Payment Order</h6>
                    <form id="paymentOrderForm" method="POST" action="{{ route('paymentOrders.store') }}">
                        @csrf
                        <div class="row">
                            <!-- To Date -->
                            <div class="col-sm-6">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="date" id="to_date" class="form-control" name="to_date"
                                    placeholder="Select To Date" required />
                            </div>

                            <!-- Company Name -->
                            <div class="col-sm-6">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" id="company_name" class="form-control" name="company_name"
                                    placeholder="Enter Company Name" required />
                            </div>
                        </div>

                        <!-- Currency Selection -->
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="currency" class="form-label">Currency</label>
                                <select id="currency" name="currency" class="form-control" required>
                                    <option value="">Select Currency</option>
                                    <option value="AED">AED</option>
                                    <option value="SAR">SAR</option>
                                    <option value="POUND">POUND</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" id="submitOrderBtn" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>


    <!-- Payment Orders Table -->
    <div class="card mt-4">
        <h5 class="card-header">Payment Order List</h5>
        <div class="table-responsive text-nowrap limited-scroll">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Payment Order Number</th>
                        <th>Company Name</th>
                        <th>Approval</th>
                        <th>Payment Status</th>
                        <th>Currency</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="paymentOrderTableBody">
                    @if ($paymentOrders->isEmpty())
                        <tr id="noDataRow">
                            <td colspan="6" class="text-center">No Data</td>
                        </tr>
                    @else
                        @foreach ($paymentOrders as $po)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $po->payment_date }}</td>
                                <td>
                                    <form action="{{ route('paymentOrders.show', ['id' => $po->payment_order_number]) }}"
                                        method="GET" style="display: inline;">
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                            style="text-decoration: underline; background: none; border: none;">
                                            {{ $po->payment_order_number }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-secondary" style="font-weight:bold">{{ $po->company_name }}</td>
                                <td>
                                    @if (auth()->user()->role === 'Admin')
                                        <form action="{{ route('paymentOrder.updateStatus', $po->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-select project-dropdown" name="status">
                                                <option value="pending" {{ $po->status == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="approved" {{ $po->status == 'approved' ? 'selected' : '' }}>
                                                    Approved</option>
                                                <option value="rejected" {{ $po->status == 'rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                            </select>

                                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                        </form>
                                    @else
                                        <span class="text-success" style="font-weight:bold">{{ $po->status }}</span>
                                    @endif
                                </td>

                                <td class="text-success" style="font-weight:bold">{{ $po->paid_status }}</td>
                                <td class="text-mute" style="font-weight:bold">{{ $po->currency }}</td>
                                <td>
                                    <!-- Delete Action -->
                                    <form action="{{ route('paymentOrders.destroy', ['id' => $po->id]) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Payment Order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
