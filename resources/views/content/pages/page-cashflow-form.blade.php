@extends('layouts/contentNavbarLayout')

@section('title', 'Cash Flow Management - Record Cash Flow')

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

    .status-approved {
        color: #4caf50;
    }
    .status-rejected {
        color: #ff6f6f;
    }
    .status-pending {
        color: #ff9800;
    }
    .status-default {
        color: #000000;
    }
</style>

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cash Flow Management /</span> Record Cash Flow
</h4>

<div class="row">
    <div class="col-md-12">
        <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none; width:80%; margin:10px auto">
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

        <!-- Cash Flow Form -->
        <div class="card">
            <div class="card-body">
                <h6>Record Cash Flow</h6>
                <form action="{{ route('cashflow.storeDPM') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" id="date" class="form-control" name="date" value="{{ old('date') }}" required />
                        </div>
                        <div class="col-sm-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" class="form-control" name="description" value="{{ old('description') }}" placeholder="E.g., DPM for Salary" required />
                        </div>
                        <div class="col-sm-4">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option disabled selected value>Choose Category</option>
                                <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>Salary</option>
                                <option value="Facility" {{ old('category') == 'Facility' ? 'selected' : '' }}>Facility</option>
                                <option value="Material" {{ old('category') == 'Material' ? 'selected' : '' }}>Material</option>
                                <option value="Overhead" {{ old('category') == 'Overhead' ? 'selected' : '' }}>Overhead</option>
                                <option value="Financial" {{ old('category') == 'Financial' ? 'selected' : '' }}>Financial</option>
                                <option value="Capital Expenditure" {{ old('category') == 'Capital Expenditure' ? 'selected' : '' }}>Capital Expenditure</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <label for="cash_outflow" class="form-label">Cash Amount</label>
                            <input type="number" step="0.01" id="cash_outflow" class="form-control" name="cash_outflow" value="{{ old('cash_outflow') }}" placeholder="Enter Cash Outflow Amount" required />
                        </div>
                        <div class="col-sm-6">
                            <label for="budget_project_id" class="form-label">Budget Project</label>
                            <select class="form-select" name="budget_project_id" required>
                                <option disabled selected value>Choose Project</option>
                                @foreach($budgetProjects as $project)
                                <option value="{{ $project->id }}" {{ old('budget_project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->reference_code }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
