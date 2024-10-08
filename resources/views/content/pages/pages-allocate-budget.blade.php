@extends('layouts/contentNavbarLayout')

@section('title', 'Allocate Budget')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<style>
    .icon-box {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80px;
        width: 80px;
        background-color: #f5f5f5;
        border-radius: 50%;
    }

    .card-body {
        padding: 1.5rem;
        height: 180px;
        min-height: 180px;
    }

    .card {}
</style>

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
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

        <h2>Approved Budget - {{ $approvedBudget->reference_code }}</h2>


        <div class="row">
            <!-- Salary Cost Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-briefcase fa-3x text-primary"></i>
                        </div>
                        <span class="fw-semibold d-block mb-1">Salary Cost</span>
                        <h3 class="card-title mb-2">{{ number_format($approvedBudget->total_salary) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Facility Cost Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-building fa-3x text-success"></i>
                        </div>
                        <span>Facility Cost</span>
                        <h3 class="card-title text-nowrap mb-1">{{ number_format($approvedBudget->total_facility_cost) }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Material Cost Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-toolbox fa-3x text-warning"></i>
                        </div>
                        <span>Material Cost</span>
                        <h3 class="card-title mb-2">{{ number_format($approvedBudget->total_material_cost) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Cost Overhead Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-cogs fa-3x text-info"></i>
                        </div>
                        <span>Cost Overhead</span>
                        <h3 class="card-title text-nowrap mb-1">{{ number_format($approvedBudget->total_cost_overhead) }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Financial Cost Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-dollar-sign fa-3x text-danger"></i>
                        </div>
                        <span>Financial Cost</span>
                        <h3 class="card-title mb-2">{{ number_format($approvedBudget->total_financial_cost) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Capital Expense Card -->
            <div class="col-lg-2 col-md-4 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-chart-pie fa-3x text-secondary"></i>
                        </div>
                        <span>Capital Expense</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ number_format($approvedBudget->total_capital_expenditure) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit Section -->
        <div class="row">
            <!-- Net Profit Before Tax -->
            <div class="col-lg-6 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-chart-line fa-3x text-success"></i>
                        </div>
                        <span>Net Profit Before Tax</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ number_format($approvedBudget->expected_net_profit_before_tax) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Net Profit After Tax -->
            <div class="col-lg-6 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="icon-box mb-2">
                            <i class="fas fa-coins fa-3x text-gold"></i>
                        </div>
                        <span>Net Profit After Tax</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ number_format($approvedBudget->expected_net_profit_after_tax) }}</h3>
                    </div>
                </div>
            </div>
        </div>




    <!-- Budget Allocation Form -->
<form method="POST" action="{{ route('budget.allocateBudgetByFinance') }}">
    @csrf
    <div class="row">
        <!-- Salary Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Salary
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_salary) }}</h5>
                    <div class="form-group">
                        <label for="salary_allocation_display">Allocate Budget for Salary</label>
                        <input type="text" class="form-control" id="salary_allocation_display"
                               name="salary_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_salary ?? 0, 0) }}"
                               oninput="formatNumber(this, 'salary_allocation_hidden')" required>
                        <input type="hidden" id="salary_allocation_hidden" name="salary_allocation"
                               value="{{ $allocatedBudget->total_salary ?? 0 }}">
                        <input type="hidden" name="approved_salary_allocation"
                               value="{{ $approvedBudget->total_salary }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Facility Cost Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Facility Cost
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_facility_cost) }}</h5>
                    <div class="form-group">
                        <label for="facility_allocation_display">Allocate Budget for Facility</label>
                        <input type="text" class="form-control" id="facility_allocation_display"
                               name="facility_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_facility_cost ?? 0, 0) }}"
                               oninput="formatNumber(this, 'facility_allocation_hidden')" required>
                        <input type="hidden" id="facility_allocation_hidden" name="facility_allocation"
                               value="{{ $allocatedBudget->total_facility_cost ?? 0 }}">
                        <input type="hidden" name="approved_facility_allocation"
                               value="{{ $approvedBudget->total_facility_cost }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Material Cost Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Material Cost
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_material_cost) }}</h5>
                    <div class="form-group">
                        <label for="material_allocation_display">Allocate Budget for Material</label>
                        <input type="text" class="form-control" id="material_allocation_display"
                               name="material_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_material_cost ?? 0, 0) }}"
                               oninput="formatNumber(this, 'material_allocation_hidden')" required>
                        <input type="hidden" id="material_allocation_hidden" name="material_allocation"
                               value="{{ $allocatedBudget->total_material_cost ?? 0 }}">
                        <input type="hidden" name="approved_material_allocation"
                               value="{{ $approvedBudget->total_material_cost }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Overhead Cost Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Overhead Cost
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_cost_overhead) }}</h5>
                    <div class="form-group">
                        <label for="overhead_allocation_display">Allocate Budget for Overhead</label>
                        <input type="text" class="form-control" id="overhead_allocation_display"
                               name="overhead_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_cost_overhead ?? 0, 0) }}"
                               oninput="formatNumber(this, 'overhead_allocation_hidden')" required>
                        <input type="hidden" id="overhead_allocation_hidden" name="overhead_allocation"
                               value="{{ $allocatedBudget->total_cost_overhead ?? 0 }}">
                        <input type="hidden" name="approved_overhead_allocation"
                               value="{{ $approvedBudget->total_cost_overhead }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Cost Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Financial Cost
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_financial_cost) }}</h5>
                    <div class="form-group">
                        <label for="financial_allocation_display">Allocate Budget for Financial</label>
                        <input type="text" class="form-control" id="financial_allocation_display"
                               name="financial_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_financial_cost ?? 0, 0) }}"
                               oninput="formatNumber(this, 'financial_allocation_hidden')" required>
                        <input type="hidden" id="financial_allocation_hidden" name="financial_allocation"
                               value="{{ $allocatedBudget->total_financial_cost ?? 0 }}">
                        <input type="hidden" name="approved_financial_allocation"
                               value="{{ $approvedBudget->total_financial_cost }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Capital Expenditure Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Capital Expenditure
                </div>
                <div class="card-body">
                    <h5 class="card-title">Approved Budget: {{ number_format($approvedBudget->total_capital_expenditure) }}</h5>
                    <div class="form-group">
                        <label for="capital_expenditure_allocation_display">Allocate Budget for Capital Expenditure</label>
                        <input type="text" class="form-control" id="capital_expenditure_allocation_display"
                               name="capital_expenditure_allocation_display" placeholder="Enter amount"
                               value="{{ number_format($allocatedBudget->total_capital_expenditure ?? 0, 0) }}"
                               oninput="formatNumber(this, 'capital_expenditure_allocation_hidden')" required>
                        <input type="hidden" id="capital_expenditure_allocation_hidden" name="capital_expenditure_allocation"
                               value="{{ $allocatedBudget->total_capital_expenditure ?? 0 }}">
                        <input type="hidden" name="approved_capital_expenditure_allocation"
                               value="{{ $approvedBudget->total_capital_expenditure }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Inputs and Submit Button -->
    <input type="hidden" name="project" value="{{ $budgetProject->id }}" required>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Allocate Budget</button>
        </div>
    </div>
</form>

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


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
