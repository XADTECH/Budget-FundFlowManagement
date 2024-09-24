<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total In Direct Cost - {{ number_format($totalInDirectCost) }}</h5>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Cost Overhead</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewCostOverheadModal">ADD NEW</button>
                        </div>
                        <p>Total overhead Cost : <span
                                style="color:#0067aa; font-weight:bold">{{ number_format($totalCostOverhead) }}<span>
                        </p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
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
                                            <td>{{ $overhead->type ?? 'no entry' }}</td>
                                            <td>{{ $overhead->po ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $overhead->expenses ?? 'no entry' }}</td>
                                            <td>{{ number_format($overhead->amount) ?? 'no entry' }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item edit-btn" data-userid="${user.id}"
                                                            data-firstname="${user.first_name}"
                                                            data-lastname="${user.last_name}"
                                                            data-phonenumber="${user.phone_number}"
                                                            data-email="${user.email}" data-role="${user.role}"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="dropdown-item delete-btn" data-id="${user.id}"><i
                                                                class="bx bx-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{ $costOverheads[0]->type ?? 'no entry' }}</td>
                                        <td>{{ $costOverheads[0]->po ?? 'no entry' }}</td>
                                        <td>{{ $project->name ?? 'no entry' }}</td>
                                        <td>Depreciation Tools</td>
                                        <td>{{ number_format($costOverheads[0]->depreciationTools($costOverheads[0]->budget_project_id)) ?? 'no entry' }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit-btn" data-userid="${user.id}"
                                                        data-firstname="${user.first_name}"
                                                        data-lastname="${user.last_name}"
                                                        data-phonenumber="${user.phone_number}"
                                                        data-email="${user.email}" data-role="${user.role}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item delete-btn" data-id="${user.id}"><i
                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Financial Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewFinancialCostModal">ADD NEW</button>
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
                                            <td>{{ $financial->type ?? 'no entry' }}</td>
                                            <td>{{ $financial->po ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $financial->expenses ?? 'no entry' }}</td>
                                            <td>{{ number_format($financial->total_cost) ?? 'no entry' }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item edit-btn" data-userid="${user.id}"
                                                            data-firstname="${user.first_name}"
                                                            data-lastname="${user.last_name}"
                                                            data-phonenumber="${user.phone_number}"
                                                            data-email="${user.email}" data-role="${user.role}"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="dropdown-item delete-btn" data-id="${user.id}"><i
                                                                class="bx bx-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
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
                            <option value="Other">Other</option> <!-- Optional for custom entries -->
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
                        <label for="expense" class="form-label">Expense</label>
                        <select class="form-select" id="expense" name="expense" required>
                            <option value="" disabled selected>Select an expense type</option>
                            <option value="Risk">Risk</option>
                            <option value="Financial Cost">Financial Cost</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label for="amount" class="form-label">Percentage</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            placeholder="Please Enter % Eg. 1%, 15%" required min="0" max="45">
                    </div>



                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Financial Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Set up the event listener when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        function overheadExpenseHandling() {
            const overheadExpenseSelect = document.getElementById('overhead-expense');
            const otherField = document.getElementById('overhead-other-expense');

            overheadExpenseSelect.addEventListener('change', function() {
                otherField.style.display = (this.value == 'Other') ? 'block' : 'none';
            });
        }
        overheadExpenseHandling();
    });
</script>
