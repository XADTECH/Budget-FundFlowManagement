@extends('layouts/contentNavbarLayout')

@section('title', 'Project Budgeting - Pages')

@section('content')

    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #c8d1da !important;
            /* Light gray for odd rows */
        }

        .table-striped tbody tr.cash-outflow {
            background-color: tomato;
            /* Tomato color for cash outflow */
        }
    </style>

    <!-- Cash Flow Filter Form -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Allocated Budget Lists</h5>
            <div class="d-flex">
                <form class="d-flex" method="GET" action="{{ route('show-allocated-budgets') }}">
                    <input type="text" name="reference_code" class="form-control me-2" placeholder="Budget Reference Code"
                        aria-label="Search" value="{{ request('reference_code') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <form class="container" method="GET" action="{{ route('show-allocated-budgets') }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="budget_project_id" class="form-label">Budget Project</label>
                    <select class="form-select" name="budget_project_id">
                        <option disabled selected value>Choose</option>
                        @foreach ($budgetProjects as $budgetProject)
                            <option {{ request('budget_project_id') == $budgetProject->id ? 'selected' : '' }}
                                value="{{ $budgetProject->id }}">{{ $budgetProject->reference_code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('show-allocated-budgets') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Cash Flow Table -->
    @if (request('reference_code') || request('budget_project_id'))
        @if ($budgetProjects->isNotEmpty())
            <div class="card mt-4">
                <div class="table-responsive text-nowrap limited-scroll">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Salary</th>
                                <th>Facility</th>
                                <th>Material</th>
                                <th>Overhead</th>
                                <th>Financial Cost</th>
                                <th>Capital Expenditure</th>
                                <th>Total DPM</th>
                                <th>Total LPO</th>
                                <th>Total Allocation</th>
                                {{-- <th>Reference Code</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allocatedBudgets as $budgetProject)
                                <tr>
                                    <td>{{ number_format($budgetProject->total_salary, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_facility_cost, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_material_cost, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_cost_overhead, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_financial_cost, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_capital_expenditure, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_dpm, 0) }}</td>
                                    <td>{{ number_format($budgetProject->total_lpo, 0) }}</td>
                                    <td>{{ number_format($budgetProject->allocated_budget, 0) }}</td>
                                    
                                    {{-- <td>{{ $budgetProject->reference_code }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-4">
                No budgets found for the given filters.
            </div>
        @endif
    @else
        <div class="alert alert-info mt-4">
            Please apply filters to view the allocated budgets.
        </div>
    @endif

@endsection
