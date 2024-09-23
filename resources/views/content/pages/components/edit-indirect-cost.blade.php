<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total In Direct Cost - {{ $totalInDirectCost }}</h5>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Cost Overhead</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewCostOverheadModal">ADD NEW</button>
                        </div>
                        <p>Total overhead Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalCostOverhead, 0) }}<span>
                        </p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>TYPE</th>
                                        <th>PO</th>
                                        <th>EXPENSE</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2.4.1 HO Cost</td>
                                        <td>OPEX</td>
                                        <td>HO COST</td>
                                        <td>{{ number_format(5300.00) }}</td>
                                    </tr>
                                    <tr>
                                        <td>2.4.2 Annual Benefit</td>
                                        <td>OPEX</td>
                                        <td>ANNUAL BENEFIT</td>
                                        <td>{{ number_format(2000.00) }}</td>
                                    </tr>
                                    <tr>
                                        <td>2.4.3 Insurance Cost</td>
                                        <td>OPEX</td>
                                        <td>INSURANCE</td>
                                        <td>{{ number_format(1500.00) }}</td>
                                    </tr>
                                    <tr>
                                        <td>2.4.4 Visa Renewal</td>
                                        <td>OPEX</td>
                                        <td>VISA RENEWAL</td>
                                        <td>{{ number_format(600.00) }}</td>
                                    </tr>
                                    <tr>
                                        <td>2.4.5 Depreciation - Tools</td>
                                        <td>OPEX</td>
                                        <td>DEPRECIATION TOOLS</td>
                                        <td>{{ number_format(800.00) }}</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Financial Cost</h3>
                            {{-- <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewFinancialCostModal">ADD NEW</button> --}}
                        </div>
                        <p>Total Financial Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalFinancialCost, 0) }}<span>
                        </p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>TYPE</th>
                                        <th>PO</th>
                                        <th>EXPENSE</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2.5.1 Risk</td>
                                        <td>OPEX</td>
                                        <td>RISK</td>
                                        <td>{{ number_format(1200.00) }}</td>
                                    </tr>
                                    <tr>
                                        <td>2.5.2 Finance Cost</td>
                                        <td>OPEX</td>
                                        <td>FINANCE COST</td>
                                        <td>{{ number_format(1800.00) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cost Overhead Modal -->
<div class="modal fade" id="addNewCostOverheadModal" tabindex="-1" aria-labelledby="addNewCostOverheadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewCostOverheadModalLabel">Add New Cost Overhead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewCostOverheadForm" action="{{ url('/pages/add-budget-project-overhead-cost') }}"
                    method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="overhead cost">Overhead Cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
              
                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select" id="project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="po" class="form-label">PO</label>
                        <select class="form-select" id="po" name="po" required>
                            <option value="OPEX">OPEX</option>
                            <option value="CAPEX">CAPEX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="overhead-expense" name="expense" required>
                            <option value="" disabled selected>Select an expense head</option>
                            <option value="HO Cost">HO Cost</option>
                            <option value="Annual Benefit">Annual Benefit</option>
                            <option value="Insurance Cost">Insurance Cost</option>
                            <option value="Visa Renewal">Visa Renewal</option>
                            <option value="Other">Other</option> <!-- Optional for custom entries -->
                        </select>
                    </div>

                    <div class="mb-3" id="other-field" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="overhead-other-expense" name="other_expense"
                            placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Please Enter the Amount" required>
                    </div>

               
    
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Cost Overhead</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Financial Cost Modal -->
<div class="modal fade" id="addNewFinancialCostModal" tabindex="-1" aria-labelledby="addNewFinancialCostModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewFinancialCostModalLabel">Add New Financial Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewFinancialCostForm" action="{{ url('/pages/add-budget-project-financial-cost') }}"
                    method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="financial cost">financial cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract"
                            placeholder="e.g., Du Civil, Insurance" required>
                    </div>
                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select" id="project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="po" class="form-label">PO</label>
                        <select class="form-select" id="po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX">OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense</label>
                        <input type="text" class="form-control" id="expense" name="expense"
                            placeholder="e.g., Risk, Finance cost" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="cost_per_month" name="cost_per_month"
                            placeholder="e.g., 1000" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="e.g., 5% for Risk, 1% for Finance cost">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="e.g., new old or other" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any"
                            value="0" placeholder="e.g., 12" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Financial Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    
    function facilityExpenseHandling() {

        const facilityExpenseSelect = document.getElementById('facilityExpense');
        const otherFacilityExpenseField = document.getElementById('otherFacilityExpenseField');

        facilityExpenseSelect.addEventListener('change', function() {
            otherFacilityExpenseField.style.display = (this.value === 'other') ? 'block' : 'none';
        });

    }
    
</script>
