@extends('layouts/contentNavbarLayout')

@section('title', 'Project Budgeting - Pages')

@section('content')

    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
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
            <h5 class="mb-0">CASH FLOW LIST</h5>
            <div class="d-flex">
                <form class="d-flex" method="GET" action="{{ route('budgets.cashflowLists') }}">
                    <input type="text" name="reference_code" class="form-control me-2" placeholder="Budget Reference Code"
                        aria-label="Search" value="{{ request('reference_code') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <form class="container" method="GET" action="{{ route('budgets.cashflowLists') }}">
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
                    <a href="{{ route('budgets.cashflowLists') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Cash Flow Table -->
    @if (request('budget_project_id') || request('reference_code'))
        <div class="card mt-4">
            <div class="table-responsive text-nowrap limited-scroll">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Cash Inflow</th>
                            <th>Cash Outflow</th>
                            <th>Committed Budget</th>
                            <th>Balance</th>
                            <th>Reference Code</th>
                            <th>Project Manager</th>
                        </tr>
                    </thead>
                    <tbody id="cashflow-table-body" class="table-border-bottom-0">
                        @foreach ($cashFlows as $cashFlow)
                            <tr class="{{ $cashFlow->cash_outflow > 0 ? 'table-danger' : '' }}">
                                <td>{{ $cashFlow->date }}</td>
                                <td>{{ $cashFlow->description }}</td>
                                <td>{{ $cashFlow->category }}</td>
                                <td>{{ number_format($cashFlow->cash_inflow, 2) }}</td>
                                <td>{{ number_format($cashFlow->cash_outflow, 2) }}</td>
                                <td>{{ number_format($cashFlow->committed_budget, 2) }}</td>
                                <td>{{ number_format($cashFlow->balance, 2) }}</td>
                                <td>{{ $cashFlow->reference_code }}</td>
                                @php
                                    $project = $budgetProjects->firstWhere('id', $cashFlow->budget_project_id);
                                    $user = $users->firstWhere('id', $project->manager_id);
                                @endphp
                                <td>{{ $user->first_name ?? 'N/A' }}</td>
                                <td>
                                    <!-- Actions (e.g., view, edit, delete) -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


@endsection
