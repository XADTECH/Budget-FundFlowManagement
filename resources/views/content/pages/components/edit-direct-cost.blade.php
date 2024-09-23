<style>
    /* Modal Height */
    .modal-dialog {
        max-height: 550px;
        /* Set maximum height for the modal */
        height: 550px;
        display: flex;
        align-items: center;
    }

    .modal-content {
        height: 100%;
    }

    /* Custom Scrollbar Styles */
    .modal-body {
        /* Custom scrollbar for Webkit browsers (Chrome, Safari) */
        overflow-x: auto;
        scrollbar-width: thin;
        /* For Firefox */
        scrollbar-color: #0067aa #e0e0e0;
        /* For Firefox */
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
        /* Width of the scrollbar */
    }

    .modal-body::-webkit-scrollbar-thumb {
        background-color: #0067aa;
        /* Color of the scrollbar thumb */
        border-radius: 4px;
        /* Optional: Rounded corners for the scrollbar thumb */
    }

    .modal-body::-webkit-scrollbar-track {
        background-color: #e0e0e0;
        /* Color of the scrollbar track */
    }
</style>

<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Direct Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total Direct Cost - {{ number_format($totalDirectCost) }}</h5>
                    <!-- Salary Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Salary</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewSalaryModal">ADD
                                NEW</button>
                        </div>
                        <p>Total Salary Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalSalary, 0) }}<span></p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>TYPE</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE HEAD</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>SITE OVERSEEING</th>
                                        <th>COST PER MONTH</th>
                                        <th>NO OF PERSON</th>
                                        <th>MONTHS</th>
                                        <th>AVERAGE COST</th>
                                        <th>TOTAL COST</th>
                                        <th>Visa Status</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->salaries as $salary)
                                        <tr>

                                            @php
                                                $project = $projects->where('id', $salary->project)->first();
                                            @endphp

                                            <td>{{ $salary->type ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $salary->po ?? 'no entry' }}</td>
                                            <td>{{ $salary->expenses ?? 'no entry' }}</td>
                                            <td>{{ $salary->status ?? 'no entry' }}</td>
                                            <td>{{ $salary->description ?? 'no entry' }}</td>
                                            <td>{{ $salary->overseeing_sites ?? 'no entry' }}</td>
                                            <td>{{ number_format($salary->cost_per_month) ?? 'no entry' }}</td>
                                            <td>{{ $salary->no_of_staff ?? 'no entry' }}</td>
                                            <td>{{ $salary->no_of_months ?? 'no entry' }}</td>
                                            <td>{{ number_format($salary->average_cost) ?? 'no entry' }}</td>
                                            <td>{{ number_format($salary->total_cost) ?? 'no entry' }}</td>
                                            <td>{{ $salary->visa_status ?? 'no entry' }}</td>
                                            <td>{{ $salary->percentage_cost ?? 'no entry' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Facilities Cost Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Facilities Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewFacilitiesModal">ADD NEW</button>
                        </div>
                        <p>Total Facility Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalFacilityCost, 0) }}<span>
                        </p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>TYPE</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE HEAD</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>COST PER MONTH</th>
                                        <th>NO OF PERSON</th>
                                        <th>MONTHS</th>
                                        <th>AVERAGE COST</th>
                                        <th>TOTAL COST</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->facilityCosts as $facility)
                                        <tr>
                                            @php
                                                $project = $projects->where('id', $facility->project)->first();
                                            @endphp
                                            <td>{{ $facility->type ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $facility->po ?? 'no entry' }}</td>
                                            <td>{{ $facility->expenses ?? 'no entry' }}</td>
                                            <td>{{ $facility->status ?? 'no entry' }}</td>
                                            <td>{{ $facility->description ?? 'no entry' }}</td>
                                            <td>{{ number_format($facility->cost_per_month) ?? 'no entry' }}</td>
                                            <td>{{ $facility->no_of_staff ?? 'no entry' }}</td>
                                            <td>{{ $facility->no_of_months ?? 'no entry' }}</td>
                                            <td>{{ number_format($facility->average_cost) ?? 'no entry' }}</td>
                                            <td>{{ number_format($facility->total_cost) ?? 'no entry' }}</td>
                                            <td>{{ $facility->percentage_cost ?? 'no entry' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Material Cost Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Material Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewMaterialModal">ADD NEW</button>
                        </div>
                        @php
                            $Mcost = $totalMaterialCost + $existingPettyCash->amount + $existingNocPayment->amount;
                        @endphp
                        <span>Total Material Cost: <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($Mcost ?? 0) }}</span></span><br>

                        <span>Petty Cash Fund: <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($existingPettyCash->amount ?? 0) }}</span></span><br>

                        <span>NOC Payment Amount: <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($existingNocPayment->amount ?? 0) }}</span></span>


                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                        <th>TYPE</th>

                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE HEAD</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>QUANITITY</th>
                                        <th>UNIT</th>
                                        <th>UNIT COST</th>
                                        <th>TOTAL COST</th>
                                        <th>AVERAGE COST</th>
                                        <th>%</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->materialCosts as $material)
                                        @php
                                            $project = $projects->where('id', $material->project)->first();
                                        @endphp

                                        <tr>
                                            <td>{{ $material->type ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $material->po ?? 'no entry' }}</td>
                                            <td>{{ $material->expenses ?? 'no entry' }}</td>
                                            <td>{{ $material->status ?? 'no entry' }}</td>
                                            <td>{{ $material->description ?? 'no entry' }}</td>
                                            <td>{{ number_format($material->quantity) ?? 'no entry' }}</td>
                                            <td>{{ $material->unit ?? 'no entry' }}</td>
                                            <td>{{ isset($material->unit_cost) ? number_format($material->unit_cost, 0) : 'no entry' }}
                                            </td>
                                            <td>{{ isset($material->total_cost) ? number_format($material->total_cost, 0) : 'no entry' }}
                                            </td>
                                            <td>{{ isset($material->average_cost) ? number_format($material->average_cost, 0) : 'no entry' }}
                                            </td>
                                            <td>{{ isset($material->percentage_cost) ? $material->percentage_cost : 'no entry' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Salary Modal -->
<div class="modal fade" id="addNewSalaryModal" tabindex="-1" aria-labelledby="addNewSalaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSalaryModalLabel">Add New Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewSalaryForm" action="{{ url('/pages/add-budget-project-salary') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Salary">Salary</option>
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
                        <label for="po" class="form-label">PO Type</label>
                        <select class="form-select" id="po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option selected value="OPEX">OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="expense" name="expense" required>
                            <option value="">Select an option</option>
                            <option value="Sr. Client Relationship Manager">Sr. Client Relationship Manager</option>
                            <option value="Sr. Manager Operations">Sr. Manager Operations</option>
                            <option value="Project Manager">Project Manager</option>
                            <option value="Project Coordinator">Project Coordinator</option>
                            <option value="Draftsman">Draftsman</option>
                            <option value="NOC Officer">NOC Officer</option>
                            <option value="Document Controller">Document Controller</option>
                            <option value="HSE / QMS Coordinator">HSE / QMS Coordinator</option>
                            <option value="HSE Engineer">HSE Engineer</option>
                            <option value="QMS Engineer">QMS Engineer</option>
                            <option value="Sr. Civil Project Engineer">Sr. Civil Project Engineer</option>
                            <option value="Civil Project Engineer">Civil Project Engineer</option>
                            <option value="Surveyor">Surveyor</option>
                            <option value="Foreman">Foreman</option>
                            <option value="Charge Hand">Charge Hand</option>
                            <option value="Mason">Mason</option>
                            <option value="Helper">Helper</option>
                            <option value="Driver Cum Helper">Driver Cum Helper</option>
                            <option value="3-Ton Driver">3-Ton Driver</option>
                            <option value="Bus Driver">Bus Driver</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="overseeing-sites-field" style="display: none;">
                        <label for="overseeing_sites" class="form-label">Number of Overseeing Sites</label>
                        <input type="number" class="form-control" id="overseeing_sites" name="overseeing_sites"
                            placeholder="Enter number of sites">
                    </div>

                    <div class="mb-3" id="other-field" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_expense" name="other_expense"
                            placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="visa_status" class="form-label">Visa Status</label>
                        <select class="form-select" id="visa_status" name="visa_status" required>
                            <option value="" disabled>Select Visa Status</option>
                            <option value="Xad Visa"
                                {{ old('visa_status', $model->visa_status ?? '') == 'Xad Visa' ? 'selected' : '' }}>Xad
                                Visa</option>
                            <option value="Contractor"
                                {{ old('visa_status', $model->visa_status ?? '') == 'Contractor' ? 'selected' : '' }}>
                                Contractor</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="cost_per_month" name="cost_per_month"
                            placeholder="e.g., 5000.00" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="e.g., we are starting new project" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="e.g., New Hiring" required>
                    </div>
                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Persons</label>
                        <input type="number" class="form-control" id="noOfPerson" name="noOfPerson" step="any"
                            placeholder="e.g., 5" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any"
                            placeholder="e.g., 12" value="1" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Add Salary</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Facilities Modal -->
<div class="modal fade" id="addNewFacilitiesModal" tabindex="-1" aria-labelledby="addNewFacilitiesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewFacilitiesModalLabel">Add New Facilities Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewFacilitiesForm" action="{{ url('/pages/add-budget-project-facility-cost') }}"
                    method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Facility Cost">Facility Cost</option>
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
                            <option value="CAPEX">CAPEX</option>
                            <option selected value="OPEX">OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="facilityExpense" name="expense" required>
                            <option value="">Select an option</option>
                            <option value="Accommodation">Accommodation</option>
                            <option value="Fuel">Fuel</option>
                            <option value="SIM">SIM</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="otherFacilityExpenseField" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_expense" name="other_expense"
                            placeholder="Specify other expense">
                    </div>



                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="cost_per_month"
                            placeholder="eg,cost per month" name="cost_per_month" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="eg, Fuel, SIM, Accomodation" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="eg, new old upgrade " required>
                    </div>
                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Person</label>
                        <input type="number" class="form-control" value="0" id="noOfPerson" name="noOfPerson"
                            step="any" placeholder="eg, no of person or blank" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" value="0" name="months"
                            step="any" placeholder="eg, no of months" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Facilities Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Material Modal -->
<div class="modal fade" id="addNewMaterialModal" tabindex="-1" aria-labelledby="addNewMaterialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMaterialModalLabel">Add New Material Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewMaterialForm" action="{{ url('/pages/add-budget-project-material-cost') }}"
                    method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Material">Material</option>
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
                            <option value="CAPEX">CAPEX</option>
                            <option selected value="OPEX">OPEX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="expenseHead" class="form-label">Expense Head</label>
                        <select class="form-select" id="materialexpenseHead" name="expense" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="consumed_material">Consumed Material</option>
                            <option value="petty_cash">Petty Cash</option>
                            <option value="noc_payment">NOC Payment</option>
                        </select>
                    </div>

                    <!-- Fields for Consumed Material -->
                    <div id="consumedMaterialFields" style="display:none">
                        <div class="mb-3">
                            <label for="material_head" class="form-label">Material Head</label>
                            <input type="text" class="form-control" id="material_head" name="material_head"
                                step="any" placeholder="e.g... Wire, Cable, Material ..">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                step="any" placeholder="e.g., 100">
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <select class="form-select" id="unit" name="unit">
                                <option value="meters">Meters</option>
                                <option value="feet">Feet</option>
                                <option value="rolls">Rolls</option>
                                <option value="pieces">Pieces</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="unit_cost" class="form-label">Unit Cost</label>
                            <input type="number" class="form-control" id="unit_cost" name="unit_cost"
                                step="any" placeholder="e.g., 50.00">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="e.g., 100-meter Ethernet cable">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status"
                                placeholder="e.g., Purchased, in stock">
                        </div>
                    </div>

                    <!-- Fields for Petty Cash -->
                    <div id="pettyCashFields" style="display:none">
                        <div class="mb-3">
                            <label for="petty_cash_amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="petty_cash_amount"
                                name="petty_cash_amount" step="any" placeholder="Enter Petty Cash">
                        </div>
                    </div>

                    <!-- Fields for NOC Payment -->
                    <div id="nocPaymentFields" style="display:none">
                        <div class="mb-3">
                            <label for="noc_amount" class="form-label">NOC Description</label>
                            <input type="text" class="form-control" id="noc_amount" name="noc_amount"
                                placeholder="Enter NOC Amount">
                        </div>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Material Cost</button>
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

        function materialExpensehandling() {
            const materialExpenseSelect = document.getElementById('materialexpenseHead');
            const consumedMaterialFields = document.getElementById('consumedMaterialFields');
            const pettyCashFields = document.getElementById('pettyCashFields');
            const nocPaymentFields = document.getElementById('nocPaymentFields');

            // Hide all conditional fields initially
            consumedMaterialFields.style.display = 'none';
            pettyCashFields.style.display = 'none';
            nocPaymentFields.style.display = 'none';

            // On material expense selection change
            materialExpenseSelect.addEventListener('change', function() {
                const selectedValue = this.value;

                // Hide all fields first
                consumedMaterialFields.style.display = 'none';
                pettyCashFields.style.display = 'none';
                nocPaymentFields.style.display = 'none';

                // Remove required attributes to avoid validation issues
                document.querySelectorAll(
                        '#consumedMaterialFields input, #pettyCashFields input, #nocPaymentFields input'
                    )
                    .forEach(input => input.removeAttribute('required'));

                // Show and enable validation for relevant fields
                if (selectedValue === 'consumed_material') {
                    consumedMaterialFields.style.display = 'block';
                    consumedMaterialFields.querySelectorAll('input').forEach(input => input
                        .setAttribute(
                            'required', 'required'));
                } else if (selectedValue === 'petty_cash') {
                    pettyCashFields.style.display = 'block';
                    pettyCashFields.querySelector('input').setAttribute('required', 'required');
                } else if (selectedValue === 'noc_payment') {
                    nocPaymentFields.style.display = 'block';
                    nocPaymentFields.querySelector('input').setAttribute('required', 'required');
                }
            });

        }

        function salaryExpenseHandling() {
            const expenseSelect = document.getElementById('expense');
            const overseeingSitesField = document.getElementById('overseeing-sites-field');
            const otherField = document.getElementById('other-field');

            expenseSelect.addEventListener('change', function() {
                var selectedValue = this.value;
                var showOverseeingSites = [
                    'Sr. Client Relationship Manager',
                    'Sr. Manager Operations',
                    'Project Manager',
                    'Sr. Civil Project Engineer'
                ].includes(selectedValue);

                // Show or hide the overseeing sites field
                overseeingSitesField.style.display = showOverseeingSites ? 'block' : 'none';

                // Show or hide the other field
                otherField.style.display = (selectedValue === 'other') ? 'block' : 'none';
            });
        }

        facilityExpenseHandling();
        materialExpensehandling();
        salaryExpenseHandling();


        // Handle form submission
        const form = document.getElementById('addNewMaterialForm');
        form.addEventListener('submit', function(event) {
            // Ensure the currently visible fields are focusable and valid
            const visibleFields = form.querySelectorAll('input[required], select[required]');
            let isValid = true;

            visibleFields.forEach(field => {
                if (!field.checkValidity()) {
                    field.focus();
                    isValid = false;
                    return false; // Stop the loop if invalid
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
   
</script>
