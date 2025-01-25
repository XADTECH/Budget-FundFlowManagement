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

<div id="loading-overlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Direct Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total Direct Cost : {{ number_format($totalDirectCost) }}</h5>

                    <!-- ========================= Salary Section ========================= -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Salary</h3>
                            <div class="d-flex">
                                <div style="display: flex; align-items: center; justify-content: right;">
                                    <!-- Separate Form for File Upload -->
                                    <form action="{{ route('salary.import') }}" method="POST"
                                          enctype="multipart/form-data"
                                          id="salary-file-upload-form" class="m-2">
                                        @csrf
                                        <!-- Hidden file input -->
                                        <input type="file" name="file" id="salary-file-upload" style="display: none;" required>
                                        <input type="hidden" name="bg_id" value="{{$project_id}}">
                                        <!-- Upload Button Triggers File Input -->
                                        <button type="button" class="btn btn-primary btn-custom"
                                                onclick="salarytriggerFileUpload()">Upload
                                        </button>
                                    </form>

                                    <!-- Download Button -->
                                    <a href="{{ route('sarlary-export',$project_id) }}"
                                       class="btn btn-primary btn-custom m-2">
                                        Download Excel
                                    </a>
                                </div>

                                @if ($budget->approval_status === 'pending')
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addNewSalaryModal">ADD NEW</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Approved</button>
                                @endif
                            </div>
                        </div>

                        <p>Total Salary Cost :
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($totalSalary, 0) }}
                            </span>
                        </p>

                        <!-- Bulk Delete Button for Salary -->
                        <button id="deleteSelectedSalariesBtn" class="btn btn-danger mb-2" style="display: none;">
                            Delete Selected
                        </button>

                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!-- NEW: Checkbox for "Select All" in Salary -->
                                        <th>
                                            <input type="checkbox" id="selectAllSalary" />
                                        </th>

                                        <th>#</th> <!-- Index column -->
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->salaries as $salary)
                                    @php
                                        $project = $projects->where('id', $salary->project)->first();
                                    @endphp
                                    <tr>
                                        <!-- NEW: Checkbox for each Salary row -->
                                        <td>
                                            <input type="checkbox" class="selectSalaryCheckbox"
                                                   value="{{ $salary->id }}">
                                        </td>

                                        <td>{{ $loop->iteration }}</td> <!-- Index -->
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

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item editSalaryBtn"
                                                       data-id="{{ $salary->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item deletesalary-btn"
                                                       data-id="{{ $salary->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ====================== End Salary Section ========================= -->

                    <!-- ==================== Facilities Cost Section ====================== -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Facilities Cost</h3>
                            <div class="d-flex">
                                <div style="display: flex; align-items: center; justify-content: right;">
                                    <!-- Separate Form for File Upload -->
                                    <form action="{{ route('facilities.import') }}" method="POST"
                                          enctype="multipart/form-data"
                                          id="facilities-file-upload-form" class="m-2">
                                        @csrf
                                        <!-- Hidden file input -->
                                        <input type="file" name="facilities-file" id="facilities-file-upload"
                                               style="display: none;" required>
                                        <input type="hidden" name="bg_id" value="{{$project_id}}">
                                        <!-- Upload Button Triggers File Input -->
                                        <button type="button" class="btn btn-primary btn-custom"
                                                onclick="facilitiestriggerFileUpload()">Upload
                                        </button>
                                    </form>

                                    <!-- Download Button -->
                                    <a href="{{ route('facility-export',$project_id) }}"
                                       class="btn btn-primary btn-custom m-2">
                                        Download Excel
                                    </a>
                                </div>

                                @if ($budget->approval_status === 'pending')
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addNewFacilitiesModal">ADD NEW</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Approved</button>
                                @endif
                            </div>
                        </div>

                        <p>Total Facility Cost :
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($totalFacilityCost, 0) }}
                            </span>
                        </p>

                        <!-- Bulk Delete Button for Facilities -->
                        <button id="deleteSelectedFacilitiesBtn" class="btn btn-danger mb-2" style="display: none;">
                            Delete Selected
                        </button>

                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!-- NEW: Checkbox for "Select All" in Facilities -->
                                        <th>
                                            <input type="checkbox" id="selectAllFacilities" />
                                        </th>

                                        <th>#</th> <!-- Index column -->
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->facilityCosts as $facility)
                                    @php
                                        $project = $projects->where('id', $facility->project)->first();
                                    @endphp
                                    <tr>
                                        <!-- NEW: Checkbox for each Facilities row -->
                                        <td>
                                            <input type="checkbox" class="selectFacilitiesCheckbox"
                                                   value="{{ $facility->id }}">
                                        </td>

                                        <td>{{ $loop->iteration }}</td> <!-- Index -->
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
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item editFacilitesBtn"
                                                       data-id="{{ $facility->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item deletefacilities"
                                                       data-id="{{ $facility->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ================== End Facilities Cost Section ==================== -->

                    <!-- ===================== Material Cost Section ====================== -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Material Cost</h3>

                            <div class="d-flex">
                                <div style="display: flex; align-items: center; justify-content: right;">
                                    <!-- Separate Form for File Upload -->
                                    <form action="{{ route('material.import') }}" method="POST"
                                          enctype="multipart/form-data"
                                          id="material-file-upload-form" class="m-2">
                                        @csrf
                                        <!-- Hidden file input -->
                                        <input type="file" name="material-file" id="material-file-upload"
                                               style="display: none;" required>
                                        <input type="hidden" name="bg_id" value="{{$project_id}}">

                                        <!-- Upload Button Triggers File Input -->
                                        <button type="button" class="btn btn-primary btn-custom"
                                                onclick="materialtriggerFileUpload()">Upload
                                        </button>
                                    </form>

                                    <!-- Download Button -->
                                    <a href="{{ route('material-export',$project_id) }}"
                                       class="btn btn-primary btn-custom m-2">
                                        Download Excel
                                    </a>
                                </div>

                                @if ($budget->approval_status === 'pending')
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addNewMaterialModal">ADD NEW</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Approved</button>
                                @endif
                            </div>
                        </div>

                        @php
                            $Mcost = $totalMaterialCost +
                                     ($existingPettyCash->amount ?? 0) +
                                     ($existingNocPayment->amount ?? 0) +
                                     (@$existingSubcon->amount ?? 0) +
                                     (@$existingThirdparty->amount ?? 0);
                        @endphp

                        <span>Total Material Cost:
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($Mcost ?? 0) }}
                            </span>
                        </span><br>

                        <span>Petty Cash Fund:
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format(num: $existingPettyCash->amount ?? 0) }}
                            </span>
                        </span><br>

                        <span>NOC Payment Amount:
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($existingNocPayment->amount ?? 0) }}
                            </span>
                        </span><br>

                        <span>Subcontractor Payment Amount:
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($existingSubcon->amount ?? 0) }}
                            </span>
                        </span><br>

                        <span>Third Party Payment Amount:
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($existingThirdparty->amount ?? 0) }}
                            </span>
                        </span>

                        <!-- Bulk Delete Button for Material -->
                        <button id="deleteSelectedMaterialsBtn" class="btn btn-danger mb-2" style="display: none;">
                            Delete Selected
                        </button>

                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!-- NEW: Checkbox for "Select All" in Materials -->
                                        <th>
                                            <input type="checkbox" id="selectAllMaterials" />
                                        </th>

                                        <th>#</th> <!-- Index Column -->
                                        <th>TYPE</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE HEAD</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>QUANTITY</th>
                                        <th>UNIT</th>
                                        <th>UNIT COST</th>
                                        <th>TOTAL COST</th>
                                        <th>AVERAGE COST</th>
                                        <th>%</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->materialCosts as $material)
                                        @php
                                            $project = $projects->where('id', $material->project)->first();
                                        @endphp

                                        <tr>
                                            <!-- NEW: Checkbox for each Material row -->
                                            <td>
                                                <input type="checkbox" class="selectMaterialsCheckbox"
                                                       value="{{ $material->id }}">
                                            </td>

                                            <td>{{ $loop->iteration }}</td> <!-- Display Index -->
                                            <td>{{ $material->type ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $material->po ?? 'no entry' }}</td>
                                            <td>{{ $material->expenses ?? 'no entry' }}</td>
                                            <td>{{ $material->status ?? 'no entry' }}</td>
                                            <td>{{ $material->description ?? 'no entry' }}</td>
                                            <td>{{ number_format($material->quantity) ?? 'no entry' }}</td>
                                            <td>{{ $material->unit ?? 'no entry' }}</td>
                                            <td>
                                                {{ isset($material->unit_cost)
                                                   ? number_format($material->unit_cost, 0)
                                                   : 'no entry' }}
                                            </td>
                                            <td>
                                                {{ isset($material->total_cost)
                                                   ? number_format($material->total_cost, 0)
                                                   : 'no entry' }}
                                            </td>
                                            <td>
                                                {{ isset($material->average_cost)
                                                   ? number_format($material->average_cost, 0)
                                                   : 'no entry' }}
                                            </td>
                                            <td>
                                                {{ isset($material->percentage_cost)
                                                   ? $material->percentage_cost
                                                   : 'no entry' }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item editMaterialBtn"
                                                           data-id="{{ $material->id }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item deleteMaterialBtn"
                                                           data-id="{{ $material->id }}">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- =================== End Material Cost Section ===================== -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========================== Modals (Add + Edit) =========================== -->

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
                            <option value="Xad Visa">Xad Visa</option>
                            <option value="Contractor">Contractor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cost_per_month_display" class="form-label">Cost Per Month</label>
                        <input type="text" class="form-control" id="cost_per_month_display"
                               name="cost_per_month_display"
                               value="{{ old('cost_per_month') ? number_format(old('cost_per_month'), 2) : '' }}"
                               placeholder="e.g., 5000.00"
                               oninput="formatNumber(this, 'cost_per_month_hidden')"
                               required />
                        <input type="hidden" id="cost_per_month_hidden" name="cost_per_month"
                               value="{{ old('cost_per_month') }}">
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
                        <input type="number" class="form-control" id="noOfPerson" name="noOfPerson"
                               step="any" placeholder="e.g., 5" value="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months"
                               step="any" placeholder="e.g., 12" value="1" required>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Add Salary</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Salary Modal -->

<!-- Facilities Modal -->
<div class="modal fade" id="addNewFacilitiesModal" tabindex="-1"
     aria-labelledby="addNewFacilitiesModalLabel"
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
                            <option value="Store">Store</option>
                            <option value="Wareshouse">Wareshouse</option>
                            <option value="Vehicle">Vehicle</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="otherFacilityExpenseField" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_expense" name="other_expense"
                               placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="facility_cost_per_month_display" class="form-label">Cost Per Month</label>
                        <input type="text" class="form-control" id="facility_cost_per_month_display"
                               name="cost_per_month_display"
                               value="{{ old('cost_per_month') ? number_format(old('cost_per_month'), 2) : '' }}"
                               placeholder="e.g., 5000.00"
                               oninput="formatNumber(this, 'facility_cost_per_month_hidden')"
                               required />
                        <input type="hidden" id="facility_cost_per_month_hidden" name="cost_per_month"
                               value="{{ old('cost_per_month') }}">
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
                        <input type="number" class="form-control" value="0" id="noOfPerson"
                               name="noOfPerson" step="any"
                               placeholder="eg, no of person or blank" required>
                    </div>

                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" value="0"
                               name="months" step="any"
                               placeholder="eg, no of months" required>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Facilities Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Facilities Modal -->

<!-- Material Modal -->
<div class="modal fade" id="addNewMaterialModal" tabindex="-1"
     aria-labelledby="addNewMaterialModalLabel"
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
                            <option value="subcontractor">Subcontractor Payment</option>
                            <option value="third_party">Third Party Payment</option>
                        </select>
                    </div>

                    <!-- Fields for Consumed Material -->
                    <div id="consumedMaterialFields" style="display:none">
                        <div class="mb-3">
                            <label for="material_head" class="form-label">Material Head</label>
                            <input type="text" class="form-control" id="material_head"
                                   name="material_head" step="any"
                                   placeholder="e.g... Wire, Cable, Material ..">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity"
                                   name="quantity" step="any" placeholder="e.g., 100">
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
                            <label for="unit_cost_display" class="form-label">Unit Cost</label>
                            <input type="text" class="form-control" id="unit_cost_display"
                                   name="unit_cost_display"
                                   value="{{ old('unit_cost') ? number_format(old('unit_cost'), 2) : '' }}"
                                   placeholder="e.g., 50.00"
                                   oninput="formatNumber(this, 'unit_cost_hidden')" />
                            <input type="hidden" id="unit_cost_hidden" name="unit_cost"
                                   value="{{ old('unit_cost') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description"
                                   name="description"
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
                            <label for="petty_cash_display" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="petty_cash_display"
                                   name="petty_cash_display"
                                   value="{{ old('petty_cash_amount') ? number_format(old('petty_cash_amount'), 2) : '' }}"
                                   placeholder="Enter Petty Cash"
                                   oninput="formatNumber(this, 'petty_cash_hidden')" />
                            <input type="hidden" id="petty_cash_hidden" name="petty_cash_amount"
                                   value="{{ old('petty_cash_amount') }}">
                        </div>
                    </div>

                    <!-- Fields for NOC Payment -->
                    <div id="nocPaymentFields" style="display:none">
                        <div class="mb-3">
                            <label for="noc_amount_display" class="form-label">NOC Description</label>
                            <input type="text" class="form-control" id="noc_amount_display"
                                   name="noc_amount_display"
                                   value="{{ old('noc_amount') ? number_format(old('noc_amount'), 2) : '' }}"
                                   placeholder="Enter NOC Amount"
                                   oninput="formatNumber(this, 'noc_amount_hidden')" />
                            <input type="hidden" id="noc_amount_hidden" name="noc_amount"
                                   value="{{ old('noc_amount') }}">
                        </div>
                    </div>

                    <div id="subcontractor" style="display:none">
                        <div class="mb-3">
                            <label for="subcontractor_amount_display" class="form-label">
                                Subcontractor Amount
                            </label>
                            <input type="text" class="form-control" id="subcontractor_amount_display"
                                   name="subcontractor_amount_display"
                                   value="{{ old('subcontractor_amount') ? number_format(old('subcontractor_amount'), 2) : '' }}"
                                   placeholder="Enter subcontractor Amount"
                                   oninput="formatNumber(this, 'subcontractor_amount_hidden')" />
                            <input type="hidden" id="subcontractor_amount_hidden" name="subcontractor_amount"
                                   value="{{ old('subcontractor_amount') }}">
                        </div>
                    </div>

                    <div id="third_party" style="display:none">
                        <div class="mb-3">
                            <label for="third_party_amount_display" class="form-label">Third Party Amount</label>
                            <input type="text" class="form-control" id="third_party_amount_display"
                                   name="third_party_amount_display"
                                   value="{{ old('third_party_amount') ? number_format(old('third_party_amount'), 2) : '' }}"
                                   placeholder="Enter Third Party Amount"
                                   oninput="formatNumber(this, 'third_party_amount_hidden')" />
                            <input type="hidden" id="third_party_amount_hidden" name="third_party_amount"
                                   value="{{ old('third_party_amount') }}">
                        </div>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Material Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Material Modal -->

<!-- Edit Salary Modal -->
<div class="modal fade" id="editSalaryModal" tabindex="-1" aria-labelledby="editSalaryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSalaryModalLabel">Edit Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSalaryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_salary_id" name="id">

                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type</label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="Salary">Salary</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_project" class="form-label">Project</label>
                        <select class="form-select" id="edit_project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_po" class="form-label">PO Type</label>
                        <select class="form-select" id="edit_po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX">OPEX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="edit_expense" name="expenses" required>
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

                    <div class="mb-3" id="edit_overseeing-sites-field" style="display: none;">
                        <label for="edit_overseeing_sites" class="form-label">Number of Overseeing Sites</label>
                        <input type="number" class="form-control" id="edit_overseeing_sites"
                               name="overseeing_sites"
                               placeholder="Enter number of sites">
                    </div>

                    <div class="mb-3" id="edit_other-field" style="display: none;">
                        <label for="edit_other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="edit_other_expense"
                               name="other_expense"
                               placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="edit_visa_status" class="form-label">Visa Status</label>
                        <select class="form-select" id="edit_visa_status" name="visa_status" required>
                            <option value="" disabled>Select Visa Status</option>
                            <option value="Xad Visa">Xad Visa</option>
                            <option value="Contractor">Contractor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="edit_cost_per_month"
                               name="cost_per_month" placeholder="e.g., 5000.00" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit_description"
                               name="description"
                               placeholder="e.g., we are starting new project" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="edit_status" name="status"
                               placeholder="e.g., New Hiring" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_noOfPerson" class="form-label">No Of Persons</label>
                        <input type="number" class="form-control" id="edit_noOfPerson"
                               name="no_of_staff" step="any"
                               placeholder="e.g., 5" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="edit_months"
                               name="no_of_months" step="any"
                               placeholder="e.g., 12" required>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Update Salary</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Salary Modal -->

<!-- Edit Facilities Modal -->
<div class="modal fade" id="editFacilitiesModal" tabindex="-1"
     aria-labelledby="editFacilitiesModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewFacilitiesModalLabel">Add New Facilities Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFacilitiesForm" method="POST">
                    @csrf
                    @method('PUT')

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
                        <select class="form-select editfaci" id="facilityExpense" name="expenses" required>
                            <option value="">Select an option</option>
                            <option value="Accommodation">Accommodation</option>
                            <option value="Fuel">Fuel</option>
                            <option value="SIM">SIM</option>
                            <option value="Store">Store</option>
                            <option value="Wareshouse">Wareshouse</option>
                            <option value="Vehicle">Vehicle</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="otherFacilityExpenseField" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_expense"
                               name="other_expense"
                               placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="faci_cost_per_month"
                               placeholder="eg,cost per month" name="cost_per_month" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editfacilitydescription"
                               name="description"
                               placeholder="eg, Fuel, SIM, Accomodation" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="editstatus" name="status"
                               placeholder="eg, new old upgrade " required>
                    </div>

                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Person</label>
                        <input type="number" class="form-control" value="0"
                               id="editfacilitynoOfPerson"
                               name="no_of_staff" step="any"
                               placeholder="eg, no of person or blank" required>
                    </div>

                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="eidtfacilitymonths" value="0"
                               name="no_of_months" step="any"
                               placeholder="eg, no of months" required>
                    </div>

                    <input type="hidden" id="edit_facility_id" name="id">
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Update Facilities Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Facilities Modal -->

<!-- Edit Material Modal -->
<div class="modal fade" id="editMaterialModal" tabindex="-1"
     aria-labelledby="editMaterialModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMaterialModalLabel">Edit Material Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMaterialForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_material_id" name="id">

                    <div class="mb-3">
                        <label for="edit_material_type" class="form-label">Type</label>
                        <select class="form-select" id="edit_material_type" name="type" required>
                            <option value="Material">Material</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_material_project" class="form-label">Project</label>
                        <select class="form-select" id="edit_material_project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_material_po" class="form-label">PO</label>
                        <select class="form-select" id="edit_material_po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX">OPEX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_material_expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="edit_material_expense" name="expense" required>
                            <option value="consumed_material">Consumed Material</option>
                            <option value="petty_cash">Petty Cash</option>
                            <option value="noc_payment">NOC Payment</option>
                            <option value="subcontractor">Subcontractor</option>
                            <option value="third_party">Third Party</option>
                        </select>
                    </div>

                    <!-- Fields for Consumed Material -->
                    <div id="edit_consumedMaterialFields">
                        <div class="mb-3">
                            <label for="edit_material_head" class="form-label">Material Head</label>
                            <input type="text" class="form-control" id="edit_material_head"
                                   name="material_head">
                        </div>
                        <div class="mb-3">
                            <label for="edit_quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="edit_quantity"
                                   name="quantity">
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit" class="form-label">Unit</label>
                            <select class="form-select" id="edit_unit" name="unit">
                                <option value="meters">Meters</option>
                                <option value="feet">Feet</option>
                                <option value="rolls">Rolls</option>
                                <option value="pieces">Pieces</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit_cost" class="form-label">Unit Cost</label>
                            <input type="number" class="form-control" id="edit_unit_cost"
                                   name="unit_cost" step="any">
                        </div>
                    </div>

                    <!-- Fields for Petty Cash -->
                    <div id="edit_pettyCashFields" style="display:none">
                        <div class="mb-3">
                            <label for="edit_petty_cash_amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="edit_petty_cash_amount"
                                   name="petty_cash_amount" step="any">
                        </div>
                    </div>

                    <!-- Fields for NOC Payment -->
                    <div id="edit_nocPaymentFields" style="display:none">
                        <div class="mb-3">
                            <label for="edit_noc_amount" class="form-label">NOC Description</label>
                            <input type="text" class="form-control" id="edit_noc_amount"
                                   name="noc_amount">
                        </div>
                    </div>

                    <!-- Fields for Subcontractor -->
                    <div id="edit_subcontractorFields" style="display:none">
                        <div class="mb-3">
                            <label for="edit_subcontractor_amount" class="form-label">Subcontractor Amount</label>
                            <input type="number" class="form-control" id="edit_subcontractor_amount"
                                   name="subcontractor_amount" step="any">
                        </div>
                    </div>

                    <!-- Fields for Third Party -->
                    <div id="edit_thirdPartyFields" style="display:none">
                        <div class="mb-3">
                            <label for="edit_thirdparty_amount" class="form-label">Third Party Amount</label>
                            <input type="number" class="form-control" id="edit_thirdparty_amount"
                                   name="third_party_amount" step="any">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_material_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit_material_description"
                               name="description" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_material_status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="edit_material_status" name="status"
                               required>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Update Material Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Material Modal -->

<script>
    // =========================== Show any success messages on page load =========================
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get('success');
        if (successMessage) {
            console.log(successMessage)
            showAlert('success', decodeURIComponent(successMessage));
            const newUrl = window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    });

    function handleSuccess(message) {
        window.location.href = window.location.pathname + '?success=' + encodeURIComponent(message);
    }

    // =========================== File Upload: Salary, Facilities, Material ======================
    function salarytriggerFileUpload() {
        document.getElementById('salary-file-upload').click();
    }
    document.getElementById('salary-file-upload').addEventListener('change', function() {
        const overlay = document.getElementById('loading-overlay');
        overlay.style.display = 'flex'; // Show the spinner
        setTimeout(() => {
            document.getElementById('salary-file-upload-form').submit(); // Submit form after delay
        }, 500); // Small delay to ensure spinner is visible
    });

    function facilitiestriggerFileUpload() {
        document.getElementById('facilities-file-upload').click();
    }
    document.getElementById('facilities-file-upload').addEventListener('change', function() {
        const overlay = document.getElementById('loading-overlay');
        overlay.style.display = 'flex'; // Show the spinner
        setTimeout(() => {
            document.getElementById('facilities-file-upload-form').submit(); // Submit form after delay
        }, 500); // Small delay to ensure spinner is visible
    });

    function materialtriggerFileUpload() {
        document.getElementById('material-file-upload').click();
    }
    document.getElementById('material-file-upload').addEventListener('change', function() {
        const overlay = document.getElementById('loading-overlay');
        overlay.style.display = 'flex'; // Show the spinner
        setTimeout(() => {
            document.getElementById('material-file-upload-form').submit(); // Submit form after delay
        }, 500);
    });

    // =========================== Number Formatting ===========================
    function formatNumber(input, hiddenFieldId) {
        // Remove non-digit characters (except for decimal point)
        let value = input.value.replace(/[^0-9.]/g, '');

        if (value) {
            let parts = value.split('.');
            let integerPart = parseInt(parts[0] || 0).toLocaleString('en-US');
            let formattedValue = integerPart;

            if (parts[1] !== undefined) {
                formattedValue += '.' + parts[1].slice(0, 2); // up to 2 decimal places
            }

            input.value = formattedValue;
            document.getElementById(hiddenFieldId).value = value;
        } else {
            input.value = '';
            document.getElementById(hiddenFieldId).value = '';
        }
    }

    // =========================== Conditional Field Handling ===========================
    // Salary Expense -> Overseeing sites & "other" expense
    function salaryExpenseHandling() {
        const expenseSelect = document.getElementById('expense');
        const overseeingSitesField = document.getElementById('overseeing-sites-field');
        const otherField = document.getElementById('other-field');

        expenseSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const showOverseeingSites = [
                'Sr. Client Relationship Manager',
                'Sr. Manager Operations',
                'Project Manager',
                'Sr. Civil Project Engineer'
            ].includes(selectedValue);

            overseeingSitesField.style.display = showOverseeingSites ? 'block' : 'none';
            otherField.style.display = (selectedValue === 'other') ? 'block' : 'none';
        });
    }

    // Facility Expense -> "other" expense
    function facilityExpenseHandling() {
        const facilityExpenseSelect = document.getElementById('facilityExpense');
        const otherFacilityExpenseField = document.getElementById('otherFacilityExpenseField');

        facilityExpenseSelect.addEventListener('change', function() {
            otherFacilityExpenseField.style.display = (this.value === 'other') ? 'block' : 'none';
        });
    }

    // Material Expense -> show/hide consumed material, petty cash, NOC, subcontractor, third party
    function materialExpensehandling() {
        const materialExpenseSelect = document.getElementById('materialexpenseHead');
        const consumedMaterialFields = document.getElementById('consumedMaterialFields');
        const pettyCashFields = document.getElementById('pettyCashFields');
        const nocPaymentFields = document.getElementById('nocPaymentFields');
        const subcontractorFields = document.getElementById('subcontractor');
        const thirdPartyFields = document.getElementById('third_party');

        materialExpenseSelect.addEventListener('change', function() {
            const selectedValue = this.value;

            // Hide everything first
            consumedMaterialFields.style.display = 'none';
            pettyCashFields.style.display = 'none';
            nocPaymentFields.style.display = 'none';
            subcontractorFields.style.display = 'none';
            thirdPartyFields.style.display = 'none';

            // Remove "required" to avoid conflicts
            document.querySelectorAll('#consumedMaterialFields input, #pettyCashFields input, #nocPaymentFields input, #subcontractor input, #third_party input')
                    .forEach(input => input.removeAttribute('required'));

            // Show relevant fields
            if (selectedValue === 'consumed_material') {
                consumedMaterialFields.style.display = 'block';
                consumedMaterialFields.querySelectorAll('input').forEach(input =>
                    input.setAttribute('required', 'required')
                );
            }
            else if (selectedValue === 'petty_cash') {
                pettyCashFields.style.display = 'block';
                pettyCashFields.querySelector('input').setAttribute('required', 'required');
            }
            else if (selectedValue === 'noc_payment') {
                nocPaymentFields.style.display = 'block';
                nocPaymentFields.querySelector('input').setAttribute('required', 'required');
            }
            else if (selectedValue === 'subcontractor') {
                subcontractorFields.style.display = 'block';
                subcontractorFields.querySelector('input').setAttribute('required', 'required');
            }
            else if (selectedValue === 'third_party') {
                thirdPartyFields.style.display = 'block';
                thirdPartyFields.querySelector('input').setAttribute('required', 'required');
            }
        });
    }

    // Initialize conditional fields on page load
    salaryExpenseHandling();
    facilityExpenseHandling();
    materialExpensehandling();

    // =========================== Form Validation for Material Add ===========================
    document.getElementById('addNewMaterialForm').addEventListener('submit', function(event) {
        const visibleFields = this.querySelectorAll('input[required], select[required]');
        let isValid = true;

        visibleFields.forEach(field => {
            if (!field.checkValidity()) {
                field.focus();
                isValid = false;
                return false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    // =========================== Edit Salary ===========================
    function openEditSalaryModal(id) {
        // AJAX get existing data
        $.ajax({
            url: `/pages/get-salary-data/${id}`,
            type: 'GET',
            success: function(data) {
                $('#edit_salary_id').val(data.id);
                $('#edit_type').val(data.type);
                $('#edit_project').val(data.project);
                $('#edit_po').val(data.po);
                $('#edit_expense').val(data.expenses);
                $('#edit_visa_status').val(data.visa_status);
                $('#edit_cost_per_month').val(data.cost_per_month);
                $('#edit_description').val(data.description);
                $('#edit_status').val(data.status);
                $('#edit_noOfPerson').val(data.no_of_staff);
                $('#edit_months').val(data.no_of_months);

                // Overseeing sites
                if ([
                    'Sr. Client Relationship Manager',
                    'Sr. Manager Operations',
                    'Project Manager',
                    'Sr. Civil Project Engineer'
                ].includes(data.expenses)) {
                    $('#edit_overseeing-sites-field').show();
                    $('#edit_overseeing_sites').val(data.overseeing_sites);
                } else {
                    $('#edit_overseeing-sites-field').hide();
                }

                if (data.expenses === 'other') {
                    $('#edit_other-field').show();
                    $('#edit_other_expense').val(data.other_expense);
                } else {
                    $('#edit_other-field').hide();
                }

                $('#editSalaryModal').modal('show');
            },
            error: function() {
                alert('Error fetching salary data');
            }
        });
    }

    // Update Salary
    $('#editSalaryForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = $('#edit_salary_id').val();

        $.ajax({
            type: "POST",
            url: `/pages/update-budget-project-salary/${id}`,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    $('#editSalaryModal').modal('hide');
                    handleSuccess('Record updated successfully');
                } else {
                    alert('Error updating salary data');
                }
            },
            error: function() {
                alert('Error updating salary data');
            }
        });
    });

    // On change event for "edit_expense"
    $('#edit_expense').on('change', function() {
        const selectedValue = $(this).val();
        if ([
            'Sr. Client Relationship Manager',
            'Sr. Manager Operations',
            'Project Manager',
            'Sr. Civil Project Engineer'
        ].includes(selectedValue)) {
            $('#edit_overseeing-sites-field').show();
        } else {
            $('#edit_overseeing-sites-field').hide();
        }

        if (selectedValue === 'other') {
            $('#edit_other-field').show();
        } else {
            $('#edit_other-field').hide();
        }
    });

    // Open Edit Salary Modal from table
    $('.editSalaryBtn').on('click', function() {
        const id = $(this).data('id');
        openEditSalaryModal(id);
    });

    // =========================== Edit Facilities ===========================
    function openEditFacilitesModal(id) {
        $.ajax({
            url: `/pages/get-facility-data/${id}`,
            type: 'GET',
            success: function(data) {
                $('#edit_facility_id').val(data.id);
                $('#type').val(data.type);
                $('#project').val(data.project);
                $('#edit_po').val(data.po);
                $('.editfaci').val(data.expenses);
                $('#editstatus').val(data.status);
                $('#faci_cost_per_month').val(data.cost_per_month);
                $('#editfacilitydescription').val(data.description);
                $('#editfacilitynoOfPerson').val(data.no_of_staff);
                $('#eidtfacilitymonths').val(data.no_of_months);

                if (data.expenses === 'other') {
                    $('#otherFacilityExpenseField').show();
                    $('#other_expense').val(data.other_expense);
                } else {
                    $('#otherFacilityExpenseField').hide();
                }

                $('#editFacilitiesModal').modal('show');
            },
            error: function() {
                alert('Error fetching facility data');
            }
        });
    }

    $('#editFacilitiesForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = $('#edit_facility_id').val();

        $.ajax({
            type: "POST",
            url: `/pages/update-facility/${id}`,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    $('#editFacilitiesModal').modal('hide');
                    handleSuccess('Facility cost updated successfully');
                } else {
                    alert('Error updating facility data');
                }
            },
            error: function() {
                alert('Error updating facility data');
            }
        });
    });

    $('.editFacilitesBtn').on('click', function() {
        const id = $(this).data('id');
        openEditFacilitesModal(id);
    });

    // =========================== Edit Material ===========================
    function openEditMaterialModal(id) {
        $.ajax({
            url: `/pages/get-material-data/${id}`,
            type: 'GET',
            success: function(data) {
                $('#edit_material_id').val(data.id);
                $('#edit_material_type').val(data.type);
                $('#edit_material_project').val(data.project);
                $('#edit_material_po').val(data.po);
                $('#edit_material_expense').val(data.expense);

                // Hide all
                $('#edit_consumedMaterialFields').hide();
                $('#edit_pettyCashFields').hide();
                $('#edit_nocPaymentFields').hide();
                $('#edit_subcontractorFields').hide();
                $('#edit_thirdPartyFields').hide();

                // Pre-fill the fields
                $('#edit_material_head').val(data.material_head || '');
                $('#edit_quantity').val(data.quantity || '');
                $('#edit_unit').val(data.unit || '');
                $('#edit_unit_cost').val(data.unit_cost || '');
                $('#edit_material_description').val(data.description || '');
                $('#edit_material_status').val(data.status || '');
                $('#edit_petty_cash_amount').val(data.petty_cash_amount || '');
                $('#edit_noc_amount').val(data.noc_amount || '');
                $('#edit_subcontractor_amount').val(data.subcontractor_amount || '');
                $('#edit_thirdparty_amount').val(data.third_party_amount || '');

                // Show relevant
                if (data.expense === 'consumed_material') {
                    $('#edit_consumedMaterialFields').show();
                } else if (data.expense === 'petty_cash') {
                    $('#edit_pettyCashFields').show();
                } else if (data.expense === 'noc_payment') {
                    $('#edit_nocPaymentFields').show();
                } else if (data.expense === 'subcontractor') {
                    $('#edit_subcontractorFields').show();
                } else if (data.expense === 'third_party') {
                    $('#edit_thirdPartyFields').show();
                }

                $('#editMaterialModal').modal('show');
            },
            error: function() {
                alert('Error fetching material data');
            }
        });
    }

    $('#editMaterialForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = $('#edit_material_id').val();

        $.ajax({
            type: "POST",
            url: `/pages/update-material/${id}`,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    $('#editMaterialModal').modal('hide');
                    handleSuccess('Material cost updated successfully');
                } else {
                    alert('Error updating material data');
                }
            },
            error: function() {
                alert('Error updating material data');
            }
        });
    });

    $('#edit_material_expense').on('change', function() {
        const selectedValue = $(this).val();
        $('#edit_consumedMaterialFields').hide();
        $('#edit_pettyCashFields').hide();
        $('#edit_nocPaymentFields').hide();
        $('#edit_subcontractorFields').hide();
        $('#edit_thirdPartyFields').hide();

        if (selectedValue === 'consumed_material') {
            $('#edit_consumedMaterialFields').show();
        } else if (selectedValue === 'petty_cash') {
            $('#edit_pettyCashFields').show();
        } else if (selectedValue === 'noc_payment') {
            $('#edit_nocPaymentFields').show();
        } else if (selectedValue === 'subcontractor') {
            $('#edit_subcontractorFields').show();
        } else if (selectedValue === 'third_party') {
            $('#edit_thirdPartyFields').show();
        }
    });

    $('.editMaterialBtn').on('click', function() {
        const id = $(this).data('id');
        openEditMaterialModal(id);
    });

    // =========================== Single-Delete (existing) ===========================
    // Salary single delete
    document.querySelectorAll('.deletesalary-btn').forEach(button => {
        button.addEventListener('click', function() {
            const salaryId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this Salary record?')) {
                deleteSalary(salaryId);
            }
        });
    });

    function deleteSalary(id) {
        fetch('/api/delete-salary', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Record deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred while deleting the record.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    }

    // Facilities single delete
    document.querySelectorAll('.deletefacilities').forEach(button => {
        button.addEventListener('click', function() {
            const facilityId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this facility record?')) {
                deleteFacilities(facilityId);
            }
        });
    });

    function deleteFacilities(id) {
        fetch('/api/delete-facilities', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Record deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred while deleting the record.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    }

    // Material single delete
    document.querySelectorAll('.deleteMaterialBtn').forEach(button => {
        button.addEventListener('click', function() {
            const materialId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this material record?')) {
                deleteMaterial(materialId);
            }
        });
    });

    function deleteMaterial(id) {
        fetch('/api/delete-material', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Record deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred while deleting the record.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    }

    // =========================== Bulk Delete (NEW) ===========================
    // 1) Salary Bulk Delete
    const selectAllSalary = document.getElementById('selectAllSalary');
    const salaryCheckboxes = document.querySelectorAll('.selectSalaryCheckbox');
    const deleteSelectedSalariesBtn = document.getElementById('deleteSelectedSalariesBtn');

    selectAllSalary.addEventListener('change', function() {
        salaryCheckboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkDeleteButton(salaryCheckboxes, deleteSelectedSalariesBtn);
    });

    salaryCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            // If not all are checked, uncheck "selectAll" 
            if (!cb.checked) selectAllSalary.checked = false;
            toggleBulkDeleteButton(salaryCheckboxes, deleteSelectedSalariesBtn);
        });
    });

    deleteSelectedSalariesBtn.addEventListener('click', function() {
        const selectedIds = Array.from(salaryCheckboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);

        if (selectedIds.length === 0) return;

        if (!confirm('Are you sure you want to delete the selected salaries?')) {
            return;
        }

        // Bulk delete fetch call
        fetch('/bulk-delete-salary', {
            method: 'POST',
            body: JSON.stringify({ ids: selectedIds }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Selected Salary records deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred during bulk deletion.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    });

    // 2) Facilities Bulk Delete
    const selectAllFacilities = document.getElementById('selectAllFacilities');
    const facilitiesCheckboxes = document.querySelectorAll('.selectFacilitiesCheckbox');
    const deleteSelectedFacilitiesBtn = document.getElementById('deleteSelectedFacilitiesBtn');

    selectAllFacilities.addEventListener('change', function() {
        facilitiesCheckboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkDeleteButton(facilitiesCheckboxes, deleteSelectedFacilitiesBtn);
    });

    facilitiesCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            if (!cb.checked) selectAllFacilities.checked = false;
            toggleBulkDeleteButton(facilitiesCheckboxes, deleteSelectedFacilitiesBtn);
        });
    });

    deleteSelectedFacilitiesBtn.addEventListener('click', function() {
        const selectedIds = Array.from(facilitiesCheckboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);

        if (selectedIds.length === 0) return;

        if (!confirm('Are you sure you want to delete the selected facilities?')) {
            return;
        }

        fetch('/bulk-delete-facilities', {
            method: 'POST',
            body: JSON.stringify({ ids: selectedIds }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Selected Facility records deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred during bulk deletion.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    });

    // 3) Materials Bulk Delete
    const selectAllMaterials = document.getElementById('selectAllMaterials');
    const materialsCheckboxes = document.querySelectorAll('.selectMaterialsCheckbox');
    const deleteSelectedMaterialsBtn = document.getElementById('deleteSelectedMaterialsBtn');

    selectAllMaterials.addEventListener('change', function() {
        materialsCheckboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkDeleteButton(materialsCheckboxes, deleteSelectedMaterialsBtn);
    });

    materialsCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            if (!cb.checked) selectAllMaterials.checked = false;
            toggleBulkDeleteButton(materialsCheckboxes, deleteSelectedMaterialsBtn);
        });
    });

    deleteSelectedMaterialsBtn.addEventListener('click', function() {
        const selectedIds = Array.from(materialsCheckboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);

        if (selectedIds.length === 0) return;

        if (!confirm('Are you sure you want to delete the selected materials?')) {
            return;
        }

        fetch('/bulk-delete-material', {
            method: 'POST',
            body: JSON.stringify({ ids: selectedIds }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Selected Material records deleted successfully');
            } else {
                showAlert('danger', data.message || 'An error occurred during bulk deletion.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    });

    // =========================== Helper: Show/Hide Bulk Delete Button ===========================
    function toggleBulkDeleteButton(checkboxes, button) {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        button.style.display = anyChecked ? 'inline-block' : 'none';
    }

    // =========================== General Alert ===========================
    function showAlert(type, message) {
        const alertBox = document.getElementById('responseAlertnew');
        const alertMessage = document.getElementById('alertMessagenew');
        alertBox.className = `alert alert-${type} alert-dismissible fade show`;
        alertMessage.textContent = message;
        alertBox.style.display = 'block';

        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);
    }
</script>
