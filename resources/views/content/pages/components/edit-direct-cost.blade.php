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
                    <h5>Total Direct Cost - {{ $totalDirectCost }}</h5>
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
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE</th>
                                        <th>DESCRIPTION</th>
                                        <th>COST PER MONTH</th>
                                        <th>NO OF PERSON</th>
                                        <th>MONTHS</th>
                                        <th>AVERAGE COST</th>
                                        <th>TOTAL COST</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->salaries as $salary)
                                        <tr>
                                            <td>{{ $salary->sn ?? 'no entry' }}</td>
                                            <td>{{ $salary->type ?? 'no entry' }}</td>
                                            <td>{{ $salary->contract ?? 'no entry' }}</td>
                                            <td>{{ $salary->project ?? 'no entry' }}</td>
                                            <td>{{ $salary->po ?? 'no entry' }}</td>
                                            <td>{{ $salary->expenses ?? 'no entry' }}</td>
                                            <td>{{ $salary->description ?? 'no entry' }}</td>
                                            <td>{{ $salary->cost_per_month ?? 'no entry' }}</td>
                                            <td>{{ $salary->no_of_staff ?? 'no entry' }}</td>
                                            <td>{{ $salary->no_of_months ?? 'no entry' }}</td>
                                            <td>{{ $salary->average_cost ?? 'no entry' }}</td>
                                            <td>{{ $salary->total_cost ?? 'no entry' }}</td>
                                            <td>{{ $salary->status ?? 'no entry' }}</td>
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
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE</th>
                                        <th>DESCRIPTION</th>

                                        <th>COST PER MONTH</th>
                                        <th>NO OF PERSON</th>
                                        <th>MONTHS</th>
                                        <th>AVERAGE COST</th>
                                        <th>TOTAL COST</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->facilityCosts as $facility)
                                        <tr>
                                            <td>{{ $facility->sn ?? 'no entry' }}</td>
                                            <td>{{ $facility->type ?? 'no entry' }}</td>
                                            <td>{{ $facility->contract ?? 'no entry' }}</td>
                                            <td>{{ $facility->project ?? 'no entry' }}</td>
                                            <td>{{ $facility->po ?? 'no entry' }}</td>
                                            <td>{{ $facility->expenses ?? 'no entry' }}</td>
                                            <td>{{ $facility->description ?? 'no entry' }}</td>
                                            <td>{{ $facility->cost_per_month ?? 'no entry' }}</td>
                                            <td>{{ $facility->no_of_staff ?? 'no entry' }}</td>
                                            <td>{{ $facility->no_of_months ?? 'no entry' }}</td>
                                            <td>{{ $facility->average_cost ?? 'no entry' }}</td>
                                            <td>{{ $facility->total_cost ?? 'no entry' }}</td>
                                            <td>{{ $facility->status ?? 'no entry' }}</td>
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
                        <p>Total Material Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalMaterialCost, 0) }}<span>
                        </p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE HEAD</th>
                                        <th>DESCRIPTION</th>
                                        <th>QUANITITY</th>
                                        <th>UNIT</th>
                                        <th>UNIT COST</th>
                                        <th>TOTAL COST</th>
                                        <th>AVERAGE COST</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->materialCosts as $material)
                                        <tr>
                                            <td>{{ $material->sn ?? 'no entry' }}</td>
                                            <td>{{ $material->type ?? 'no entry' }}</td>
                                            <td>{{ $material->contract ?? 'no entry' }}</td>
                                            <td>{{ $material->project ?? 'no entry' }}</td>
                                            <td>{{ $material->po ?? 'no entry' }}</td>
                                            <td>{{ $material->expenses ?? 'no entry' }}</td>
                                            <td>{{ $material->description ?? 'no entry' }}</td>
                                            <td>{{ $material->quantity ?? 'no entry' }}</td>
                                            <td>{{ $material->unit ?? 'no entry' }}</td>
                                            <td>{{ $material->unit_cost ?? 'no entry' }}</td>
                                            <td>{{ $material->total_cost ?? 'no entry' }}</td>
                                            <td>{{ $material->average_cost ?? 'no entry' }}</td>
                                            <td>{{ $material->status ?? 'no entry' }}</td>
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
                        <input type="number" class="form-control" id="overseeing_sites" name="overseeing_sites" placeholder="Enter number of sites">
                    </div>
                    
                    <div class="mb-3" id="other-field" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_expense" name="other_expense" placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="visa_status" class="form-label">Visa Status</label>
                        <select class="form-select" id="visa_status" name="visa_status" required>
                            <option value="" disabled>Select Visa Status</option>
                            <option value="Xad Visa" {{ old('visa_status', $model->visa_status ?? '') == 'Xad Visa' ? 'selected' : '' }}>Xad Visa</option>
                            <option value="Contractor" {{ old('visa_status', $model->visa_status ?? '') == 'Contractor' ? 'selected' : '' }}>Contractor</option>
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
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract"
                            placeholder="eg, Annual Maintenance Contract" required>
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
                        <input type="text" class="form-control" id="expense" name="expense"
                            placeholder="eg, Facility Cost" required>
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
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract"
                            placeholder="e.g., Annual Maintenance Contract" required>
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
                        <input type="text" class="form-control" id="expense" name="expense"
                            placeholder="e.g., Ethernet Cables" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" step="any"
                            placeholder="e.g., 100" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <select class="form-select" id="unit" name="unit" required>
                            <option value="meters">Meters</option>
                            <option value="feet">Feet</option>
                            <option value="rolls">Rolls</option>
                            <option value="pieces">Pieces</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="unit_cost" class="form-label">Unit Cost</label>
                        <input type="number" class="form-control" id="unit_cost" name="unit_cost" step="any"
                            placeholder="e.g., 50.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="e.g., 100-meter Ethernet cable" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="e.g., Purchased, in stock other" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Material Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('expense').addEventListener('change', function() {
        var overseeingSitesField = document.getElementById('overseeing-sites-field');
        var otherField = document.getElementById('other-field');
        
        var selectedValue = this.value;
        var showOverseeingSites = [
            'Sr. Client Relationship Manager',
            'Sr. Manager Operations',
            'Project Manager',
            'Sr. Civil Project Engineer'
        ].includes(selectedValue);
        
        if (showOverseeingSites) {
            overseeingSitesField.style.display = 'block';
        } else {
            overseeingSitesField.style.display = 'none';
        }
        
        if (selectedValue === 'other') {
            otherField.style.display = 'block';
        } else {
            otherField.style.display = 'none';
        }
    });
</script>
