<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container mt-4">
    <div id="responseAlertnew" class="alert alert-info alert-dismissible fade show" role="alert"
         style="display:none; width:80%; margin:10px auto">
        <span id="alertMessagenew"></span>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total In Direct Cost - {{ number_format($totalInDirectCost) }}</h5>

                    <!-- ======================== Overhead Section ======================== -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Cost Overhead</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addNewCostOverheadModal">
                                ADD NEW
                            </button>
                        </div>

                        <p>
                            Total Overhead Cost :
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($totalCostOverhead, 0) }}
                            </span>
                        </p>

                        <!-- NEW: Bulk Delete Button for Overhead -->
                        <button id="deleteSelectedOverheadsBtn" class="btn btn-danger mb-2" style="display: none;">
                            Delete Selected
                        </button>

                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- NEW: "Select All" for overhead -->
                                        <th>
                                            <input type="checkbox" id="selectAllOverhead" />
                                        </th>

                                        <th>#</th> <!-- Index column -->
                                        <th>TYPE</th>
                                        <th>PO</th>
                                        <th>PROJECT</th>
                                        <th>EXPENSE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($budget->costOverheads as $overhead)
                                    @php
                                        $project = $projects->where('id', $overhead->project)->first();
                                    @endphp
                                    <tr>
                                        <!-- NEW: Overhead row checkbox -->
                                        <td>
                                            <input type="checkbox" class="selectOverheadCheckbox"
                                                   value="{{ $overhead->id }}">
                                        </td>

                                        <td>{{ $loop->iteration }}</td> <!-- Index -->
                                        <td>{{ $overhead->type ?? 'no entry' }}</td>
                                        <td>{{ $overhead->po ?? 'no entry' }}</td>
                                        <td>{{ $project->name ?? 'no entry' }}</td>
                                        <td>{{ $overhead->expenses ?? 'no entry' }}</td>
                                        <td>{{ number_format($overhead->amount, 0) ?? 'no entry' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item editcostBtn" data-id="{{ $overhead->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item deletecostbtn" data-id="{{ $overhead->id }}">
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
                    <!-- ====================== End Overhead Section ====================== -->

                    <!-- ===================== Financial Cost Section ===================== -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Financial Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addNewFinancialCostModal">
                                ADD NEW
                            </button>
                        </div>
                        <p>
                            Total Financial Cost :
                            <span style="color:#0067aa; font-weight:bold">
                                {{ number_format($totalFinancialCost, 0) }}
                            </span>
                        </p>

                        <!-- NEW: Bulk Delete Button for Financial -->
                        <button id="deleteSelectedFinancialBtn" class="btn btn-danger mb-2" style="display: none;">
                            Delete Selected
                        </button>

                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- NEW: "Select All" for financial -->
                                        <th>
                                            <input type="checkbox" id="selectAllFinancial" />
                                        </th>
                                        <th>#</th> <!-- Index column -->
                                        <th>TYPE</th>
                                        <th>PO</th>
                                        <th>PROJECT</th>
                                        <th>EXPENSE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($budget->financialCosts as $financial)
                                    @php
                                        $project = $projects->where('id', $financial->project)->first();
                                    @endphp
                                    <tr>
                                        <!-- NEW: Financial row checkbox -->
                                        <td>
                                            <input type="checkbox" class="selectFinancialCheckbox"
                                                   value="{{ $financial->id }}">
                                        </td>

                                        <td>{{ $loop->iteration }}</td> <!-- Index -->
                                        <td>{{ $financial->type ?? 'no entry' }}</td>
                                        <td>{{ $financial->po ?? 'no entry' }}</td>
                                        <td>{{ $project->name ?? 'no entry' }}</td>
                                        <td>{{ $financial->expenses ?? 'no entry' }}</td>
                                        <td>{{ number_format($financial->total_cost, 0) ?? 'no entry' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item editfinancialbtn"
                                                       data-id="{{ $financial->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item deletefinancialbtn"
                                                       data-id="{{ $financial->id }}">
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
                    <!-- =================== End Financial Cost Section =================== -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== ADD NEW Overhead Modal ==================== -->
<div class="modal fade" id="addNewCostOverheadModal" tabindex="-1"
     aria-labelledby="addNewCostOverheadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewCostOverheadModalLabel">Add New Cost Overhead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewCostOverheadForm"
                      action="{{ url('/pages/add-budget-project-overhead-cost') }}"
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
                            <option selected value="OPEX">OPEX</option>
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
                            <option value="Other">Other</option> <!-- Optional -->
                        </select>
                    </div>
                    <div class="mb-3" id="overhead-other-expense" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" name="other_expense"
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
<!-- ================== End ADD NEW Overhead Modal ================== -->

<!-- ================== ADD NEW Financial Cost Modal ================ -->
<div class="modal fade" id="addNewFinancialCostModal" tabindex="-1"
     aria-labelledby="addNewFinancialCostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewFinancialCostModalLabel">Add New Financial Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewFinancialCostForm"
                      action="{{ url('/pages/add-budget-project-financial-cost') }}"
                      method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="financial cost">Financial Cost</option>
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
                    <div class="mb-3" id="expenseDropdown">
                        <label for="expense" class="form-label">Expense</label>
                        <select class="form-select" id="expense" name="expense" required>
                            <option disabled>Select an expense type</option>
                            <option value="Risk">Risk</option>
                            <option value="Financial Cost">Financial Cost</option>
                        </select>
                    </div>
                    <div class="mb-3 d-none" id="financeHeadExpense">
                        <label for="finance_head" class="form-label">Finance Head Expense</label>
                        <input type="text" class="form-control" id="finance_head" name="finance_head"
                               placeholder="Enter Finance Head Expense">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Input Type</label>
                        <select class="form-select" id="inputType" required>
                            <option value="percentage" selected>Percentage</option>
                            <option value="financial">Financial Amount</option>
                        </select>
                    </div>
                    <div class="mb-3" id="percentageField">
                        <label for="percentage" class="form-label">Percentage</label>
                        <input type="number" class="form-control" id="percentage" name="percentage"
                               placeholder="Please Enter % Eg. 1%, 15%" min="0" max="100">
                    </div>
                    <div class="mb-3 d-none" id="financialField">
                        <label for="financialAmount" class="form-label">Financial Amount</label>
                        <input type="number" class="form-control" id="financialAmount" name="financial_amount"
                               placeholder="Enter Financial Amount" min="0">
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Add Financial Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ================ End ADD NEW Financial Cost Modal =============== -->

<!-- ================== EDIT Overhead Modal ========================= -->
<div class="modal fade" id="editCostOverheadModal" tabindex="-1"
     aria-labelledby="editCostOverheadModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cost OverHead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCostForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_overhead_type" class="form-label">Type</label>
                        <select class="form-select" id="edit_overhead_type" name="type" required>
                            <option value="overhead cost">Overhead Cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_cost_project" class="form-label">Project</label>
                        <select class="form-select" id="edit_cost_project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_cost_po" class="form-label">PO</label>
                        <select class="form-select" id="edit_cost_po" name="po" required>
                            <option selected value="OPEX">OPEX</option>
                            <option value="CAPEX">CAPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="overhead-edit-expense" class="form-label">Expense Head</label>
                        <select class="form-select" id="overhead-edit-expense" name="expenses" required>
                            <option value="" disabled selected>Select an expense head</option>
                            <option value="HO Cost">HO Cost</option>
                            <option value="Annual Benefit">Annual Benefit</option>
                            <option value="Insurance Cost">Insurance Cost</option>
                            <option value="Visa Renewal">Visa Renewal</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3" id="overhead-edit-other-expense" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_cost_expense"
                               name="other_expense" placeholder="Specify other expense">
                    </div>
                    <div class="mb-3">
                        <label for="cost_amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="cost_amount" name="amount"
                               placeholder="Please Enter the Amount" required>
                    </div>

                    <input type="hidden" id="edit_cost_id" name="id">
                    <input type="hidden" name="budget_project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Update Cost Overhead</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ===================== End EDIT Overhead Modal ================== -->

<!-- ================== EDIT Financial Modal ======================== -->
<div class="modal fade" id="editNewFinancialCostModal" tabindex="-1"
     aria-labelledby="editNewFinancialCostModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Financial Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFinancialForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="financial_type" class="form-label">Type</label>
                        <select class="form-select" id="financial_type" name="type" required>
                            <option value="financial cost">financial cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="financial_project" class="form-label">Project</label>
                        <select class="form-select" id="financial_project" name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="financial_po" class="form-label">PO</label>
                        <select class="form-select" id="financial_po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX" selected>OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="financial_expense" class="form-label">Expense</label>
                        <select class="form-select" id="financial_expense" name="expenses" required>
                            <option value="" disabled selected>Select an expense type</option>
                            <option value="Risk">Risk</option>
                            <option value="Financial Cost">Financial Cost</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="financial_amount" class="form-label">Percentage</label>
                        <input type="number" class="form-control" id="financial_amount" name="amount"
                               placeholder="Please Enter % Eg. 1%, 15%" required min="0" max="45">
                    </div>

                    <input type="hidden" id="financial_id" name="id">
                    <input type="hidden" name="budget_project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Update Cost Financial</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- =================== End EDIT Financial Modal =================== -->

<script>
    // ========================== "Other" Overhead Toggle ======================
    document.addEventListener('DOMContentLoaded', function() {
        const overheadExpenseSelect = document.getElementById('overhead-expense');
        const overheadOtherField = document.getElementById('overhead-other-expense');
        overheadExpenseSelect.addEventListener('change', function() {
            overheadOtherField.style.display = (this.value === 'Other') ? 'block' : 'none';
        });
    });

    // ====================== Overhead Edit: "Other" Toggle ====================
    $('#overhead-edit-expense').on('change', function() {
        const overheadOtherField = $('#overhead-edit-other-expense');
        if ($(this).val() === 'Other') {
            overheadOtherField.show();
        } else {
            overheadOtherField.hide();
        }
    });

    // ==================== Show/Hide Fields for Financial Add =================
    const inputType = document.getElementById("inputType");
    const percentageField = document.getElementById("percentageField");
    const financialField = document.getElementById("financialField");
    const expenseDropdown = document.getElementById("expenseDropdown");
    const financeHeadExpense = document.getElementById("financeHeadExpense");
    const percentageInput = document.getElementById("percentage");
    const financialInput = document.getElementById("financialAmount");

    if (inputType) {
        inputType.addEventListener("change", function () {
            if (inputType.value === "percentage") {
                // Show percentage input, hide financial amount
                percentageField.classList.remove("d-none");
                financialField.classList.add("d-none");
                expenseDropdown.classList.remove("d-none");
                financeHeadExpense.classList.add("d-none");

                percentageInput.required = true;
                financialInput.required = false;
                financialInput.value = ''; // Clear financial amount
            } else {
                // Show financial amount input, hide percentage
                financialField.classList.remove("d-none");
                percentageField.classList.add("d-none");
                expenseDropdown.classList.add("d-none");
                financeHeadExpense.classList.remove("d-none");

                financialInput.required = true;
                percentageInput.required = false;
                percentageInput.value = ''; // Clear percentage
            }
        });
    }

    // =========================== Edit Cost Overhead ==========================
    function openEditCostOverHeadModal(id) {
        $.ajax({
            url: `/pages/get-costoverhead-data/${id}`,
            type: 'GET',
            success: function(data) {
                $('#edit_cost_id').val(data.id);
                $('#edit_overhead_type').val(data.type);
                $('#edit_cost_project').val(data.project);
                $('#edit_cost_po').val(data.po);
                $('#overhead-edit-expense').val(data.expenses);
                $('#cost_amount').val(data.amount);

                // If it's an unknown expense, fallback to "Other"
                if (!['HO Cost','Annual Benefit','Insurance Cost','Visa Renewal','Other'].includes(data.expenses)) {
                    $('#overhead-edit-expense').val("Other");
                    $('#overhead-edit-other-expense').show();
                    $('#other_cost_expense').val(data.expenses);
                } else {
                    $('#overhead-edit-other-expense').hide();
                }

                $('#editCostOverheadModal').modal('show');
            },
            error: function() {
                alert('Error fetching overhead data');
            }
        });
    }

    $('#editCostForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = $('#edit_cost_id').val();

        $.ajax({
            type: "POST",
            url: `/pages/update-costoverhead/${id}`,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    showAlert('success', 'Record updated successfully.');
                    $('#editCostOverheadModal').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    alert('Error updating overhead cost data');
                }
            },
            error: function() {
                alert('Error updating overhead cost data');
            }
        });
    });

    $('.editcostBtn').on('click', function() {
        openEditCostOverHeadModal($(this).data('id'));
    });

    // =========================== Edit Financial ==============================
    function openEditFinancialModal(id) {
        $.ajax({
            url: `/pages/get-financial-data/${id}`,
            type: 'GET',
            success: function(data) {
                $('#financial_id').val(data.id);
                $('#financial_type').val(data.type);
                $('#financial_project').val(data.project);
                $('#financial_po').val(data.po);
                $('#financial_expense').val(data.expenses);
                $('#financial_amount').val(data.percentage);

                $('#editNewFinancialCostModal').modal('show');
            },
            error: function() {
                alert('Error fetching financial data');
            }
        });
    }

    $('#editFinancialForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = $('#financial_id').val();

        $.ajax({
            type: "POST",
            url: `/pages/update-financial/${id}`,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    showAlert('success', 'Record updated successfully.');
                    $('#editNewFinancialCostModal').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    alert('Error updating financial data');
                }
            },
            error: function() {
                alert('Error updating financial data');
            }
        });
    });

    $('.editfinancialbtn').on('click', function() {
        openEditFinancialModal($(this).data('id'));
    });

    // ===================== Single Delete Overhead ============================
    document.querySelectorAll('.deletecostbtn').forEach(button => {
        button.addEventListener('click', function() {
            const overheadId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this overhead record?')) {
                deleteCostOverHead(overheadId);
            }
        });
    });

    function deleteCostOverHead(id) {
        fetch('/api/delete-costoverhead', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.success);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('danger', data.message || 'An error occurred while deleting the record.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    }

    // ===================== Single Delete Financial ==========================
    document.querySelectorAll('.deletefinancialbtn').forEach(button => {
        button.addEventListener('click', function() {
            const financialId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this financial record?')) {
                deleteFinancial(financialId);
            }
        });
    });

    function deleteFinancial(id) {
        fetch('/api/delete-financial', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.success);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('danger', data.message || 'An error occurred while deleting the record.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    }

    // ===================== Bulk Delete Overhead ============================
    const selectAllOverhead = document.getElementById('selectAllOverhead');
    const overheadCheckboxes = document.querySelectorAll('.selectOverheadCheckbox');
    const deleteSelectedOverheadsBtn = document.getElementById('deleteSelectedOverheadsBtn');

    if (selectAllOverhead && overheadCheckboxes.length) {
        selectAllOverhead.addEventListener('change', function() {
            overheadCheckboxes.forEach(cb => (cb.checked = this.checked));
            toggleBulkDeleteButton(overheadCheckboxes, deleteSelectedOverheadsBtn);
        });

        overheadCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                if (!cb.checked) selectAllOverhead.checked = false;
                toggleBulkDeleteButton(overheadCheckboxes, deleteSelectedOverheadsBtn);
            });
        });
    }

    deleteSelectedOverheadsBtn.addEventListener('click', function() {
        const selectedIds = Array.from(overheadCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (!selectedIds.length) return;

        if (!confirm('Are you sure you want to delete the selected overhead records?')) {
            return;
        }

        fetch('/bulk-delete-overhead', {
            method: 'POST',
            body: JSON.stringify({ ids: selectedIds }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                handleSuccess( 'Selected Overhead records deleted successfully');
                              

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('danger', data.message || 'An error occurred during bulk deletion.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    });

    // ===================== Bulk Delete Financial ============================
    const selectAllFinancial = document.getElementById('selectAllFinancial');
    const financialCheckboxes = document.querySelectorAll('.selectFinancialCheckbox');
    const deleteSelectedFinancialBtn = document.getElementById('deleteSelectedFinancialBtn');

    if (selectAllFinancial && financialCheckboxes.length) {
        selectAllFinancial.addEventListener('change', function() {
            financialCheckboxes.forEach(cb => (cb.checked = this.checked));
            toggleBulkDeleteButton(financialCheckboxes, deleteSelectedFinancialBtn);
        });

        financialCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                if (!cb.checked) selectAllFinancial.checked = false;
                toggleBulkDeleteButton(financialCheckboxes, deleteSelectedFinancialBtn);
            });
        });
    }

    deleteSelectedFinancialBtn.addEventListener('click', function() {
        const selectedIds = Array.from(financialCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (!selectedIds.length) return;

        if (!confirm('Are you sure you want to delete the selected financial records?')) {
            return;
        }

        fetch('/bulk-delete-financial', {
            method: 'POST',
            body: JSON.stringify({ ids: selectedIds }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                handleSuccess('Selected Financial records deleted successfully');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('danger', data.message || 'An error occurred during bulk deletion.');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showAlert('danger', 'A network error occurred. Please try again.');
        });
    });

    // ===================== Toggle Bulk Delete Buttons =======================
    function toggleBulkDeleteButton(checkboxes, button) {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        button.style.display = anyChecked ? 'inline-block' : 'none';
    }

    // ============================= Alerts ==================================
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
