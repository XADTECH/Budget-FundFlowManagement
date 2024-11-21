@extends('layouts/contentNavbarLayout')

@section('title', 'Payment Management - Pages')

@section('content')

    <style>
        .limited-scroll {
            max-height: 200px;
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
    </style>

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

            @if ($errors->any())
                <div class="alert alert-danger" id="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Payment Order Form -->
            <div class="card">
                <div class="card-body">
                    <h6>Create Payment Order</h6>
                    <form id="paymentOrderForm" method="POST" action="{{ route('paymentOrder.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" id="payment_date" class="form-control" name="payment_date"
                                    placeholder="Enter Payment Date" required />
                            </div>
                            <div class="col-sm-6">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-select" required>
                                    <option disabled selected value>Choose Method</option>
                                    <option value="cash">Cash</option>
                                    <option value="online transaction">Online Transaction</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="bank transfer">Bank Transfer</option>
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
                        <th>Purchase Order Number</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody id="paymentOrderTableBody">
                    @if ($paymentOrders->isEmpty())
                        <tr id="noDataRow">
                            <td colspan="3" class="text-center">No Data</td>
                        </tr>
                    @else
                        @foreach ($paymentOrders as $po)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $po->payment_date }}</td>
                                <td>
                                    <form action="{{ route('paymentOrder.show') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="payment_order_number"
                                            value="{{ $po->payment_order_number }}">
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                            style="text-decoration: underline; background: none; border: none;">
                                            {{ $po->payment_order_number }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $po->payment_method }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>



@endsection
