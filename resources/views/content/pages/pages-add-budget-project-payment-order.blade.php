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
                            <div class="col-sm-6">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="date" id="to_date" class="form-control" name="to_date"
                                    placeholder="Select To Date" required />
                            </div>
                            <div class="col-sm-6">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" id="company_name" class="form-control" name="company_name"
                                    placeholder="Enter Company Name" required />
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
                        <th>Approval</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="paymentOrderTableBody">
                    @if ($paymentOrders->isEmpty())
                        <tr id="noDataRow">
                            <td colspan="5" class="text-center">No Data</td>
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
                                <td class="text-success" style="font-weight:bold">{{ $po->status }}</td>
                                <td class="text-success" style="font-weight:bold">{{ $po->paid_status }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    



@endsection
