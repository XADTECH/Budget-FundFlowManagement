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
                            <label for="cash_outflow_display" class="form-label">Cash Outflow Amount</label>
                            <input type="text" class="form-control" id="cash_outflow_display" name="cash_outflow_display"
                                   value="{{ old('cash_outflow') ? number_format(old('cash_outflow'), 2) : '' }}"
                                   placeholder="Enter Cash Outflow Amount" oninput="formatNumber(this, 'cash_outflow_hidden')"  />
                            <input type="hidden" id="cash_outflow_hidden" name="cash_outflow"
                                   value="{{ old('cash_outflow') }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="cash_inflow_display" class="form-label">Cash Inflow Amount</label>
                            <input type="text" class="form-control" id="cash_inflow_display" name="cash_inflow_display"
                                   value="{{ old('cash_inflow') ? number_format(old('cash_inflow'), 2) : '' }}"
                                   placeholder="Enter Cash Inflow Amount" oninput="formatNumber(this, 'cash_inflow_hidden')"  />
                            <input type="hidden" id="cash_inflow_hidden" name="cash_inflow"
                                   value="{{ old('cash_inflow') }}">
                        </div>
                        <div class="col-sm-6 mt-2">
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

<script>
    function formatNumber(input, hiddenFieldId) {
        // Remove non-digit characters (except for decimal point)
        let value = input.value.replace(/[^0-9.]/g, '');

        if (value) {
            let parts = value.split('.');
            let integerPart = parseInt(parts[0]).toLocaleString('en-US');
            let formattedValue = integerPart;

            if (parts[1] !== undefined) {
                formattedValue += '.' + parts[1].slice(0, 2); // Allow up to 2 decimal places
            }

            input.value = formattedValue;
            document.getElementById(hiddenFieldId).value = value;
        } else {
            input.value = '';
            document.getElementById(hiddenFieldId).value = '';
        }
    }
</script>
