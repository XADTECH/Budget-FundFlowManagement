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
                <h3 class="dropdown-header">CAPEX || Total Cost ▼</h3>
                <div class="dropdown-content">
                    <!-- Salary Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Total CAPEX : {{ number_format($totalCapitalExpenditure) }} AED</h5>
                                @php
                                    $totalOPEX = $totalDirectCost + $totalInDirectCost + $totalNetProfitBeforeTax;
                                @endphp
                                <h6>Total OPEX: {{ number_format($totalOPEX) }} AED</h6>
                                <h6>Total OPEX + CAPEX : {{ number_format($totalOPEX + $totalCapitalExpenditure) }} AED
                                </h6>
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewCapitalExpense">ADD CAPEX</button>
                        </div>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th> <!-- Index column -->

                                        <th>TYPE</th>
                                        <th>PROJECT</th>
                                        <th>PO</th>
                                        <th>EXPENSE</th>
                                        <th>QUANTITY</th>
                                        <th>COST</th>
                                        <th>TOTAL COST</th>
                                        <th>DESCRIPTION</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->capitalExpenditures as $capital)
                                        @php
                                            $project = $projects->where('id', $capital->project)->first();
                                        @endphp

                                        <tr>
                                            <td>{{ $loop->iteration }}</td> <!-- Index -->

                                            <td>{{ $capital->type ?? 'no entry' }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $capital->po ?? 'no entry' }}</td>
                                            <td>{{ $capital->expenses ?? 'no entry' }}</td>
                                            <td>{{ $capital->total_number ?? 'no entry' }}</td>
                                            <td>{{ number_format($capital->cost)?? 'no entry' }}</td>
                                            <td>{{ number_format($capital->total_cost) ?? 'no entry' }}</td>
                                            <td>{{ $capital->description ?? 'no entry' }}</td>
                                            <td>{{ $capital->status ?? 'no entry' }}</td>


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

<!-- Capital Expenditure Modal -->
<div class="modal fade" id="addNewCapitalExpense" tabindex="-1" aria-labelledby="addNewSalaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSalaryModalLabel">Add New Capital Expenditure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewCapitalExpenseForm" action="{{ url('/pages/add-budget-capital-expense') }}"
                    method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Capital Expenditure">Capital Expenditure</option>
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
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="expense" class="form-label">Equipment</label>
                        <select class="form-control" id="financial-expense" name="expense" required>
                            <option value="">Select a Equipment</option>
                            <option value="Cable Detector">Cable Detector</option>
                            <option value="Plate Compactor">Plate Compactor</option>
                            <option value="Generator 5 kva"> Generator 5 kva</option>
                            <option value="Jack Hammer">Jack Hammer</option>
                            <option value="Cable Pulling Rod 200m"> Cable Pulling Rod 200m</option>
                            <option value="Cable Pulling Rod 300m"> Cable Pulling Rod 300m</option>
                            <option value="Cable Pulling Rod 500m 16mm">Cable Pulling Rod 500m 16mm</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="financial-other-expense" style="display: none;">
                        <label for="other_expense" class="form-label">Other</label>
                        <input type="text" class="form-control" name="other_expense"
                            placeholder="Specify other expense">
                    </div>

                    <div class="mb-3">
                        <label for="total_number" class="form-label">Total No</label>
                        <input type="number" class="form-control" id="total_number" name="total_number"
                            placeholder="Enter Quantity ..." required>
                    </div>

                    <div class="mb-3">
                        <label for="cost" class="form-label">Cost</label>
                        <input type="text" class="form-control" id="cost" name="cost"
                            placeholder="Enter Cost ..." required oninput="formatNumber(this, 'cost_hidden')">
                        <!-- Hidden field to store the raw numeric value -->
                        <input type="hidden" id="cost_hidden" name="cost_hidden">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="e.g., 5.1 Cable Detector" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="e.g., new, old" required>
                    </div>


                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add CAPEX</button>
                </form>
            </div>
        </div>
    </div>
</div>



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

        // Log the value for debugging
        console.log("Formatted Value:", formattedValue);
        console.log("Hidden Field Value:", value);
    } else {
        input.value = '';
        document.getElementById(hiddenFieldId).value = '';
    }
}


    // Set up the event listener when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        function overheadExpenseHandling() {
            const overheadExpenseSelect = document.getElementById('financial-expense');
            const otherField = document.getElementById('financial-other-expense');

            overheadExpenseSelect.addEventListener('change', function() {
                otherField.style.display = (this.value == 'Other') ? 'block' : 'none';
            });
        }
        overheadExpenseHandling();
    });
</script>
