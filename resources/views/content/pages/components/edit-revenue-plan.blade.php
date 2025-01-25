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
                <h3 class="dropdown-header">Renenue & Profit ▼</h3>
                <div class="dropdown-content">
                    <!-- Salary Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Net Profit : {{ number_format($totalRevenue, 0, '.', ',') }}</h5>
                            <div class="d-flex">
                                <div style="display: flex; align-items: center; justify-content: right;">
                                    <!-- Separate Form for File Upload -->
                                    <form action="{{ route('revenue.import') }}" method="POST"
                                        enctype="multipart/form-data" id="revenue-file-upload-form" class="m-2">
                                        @csrf
                                        <!-- Hidden file input -->
                                        <input type="file" name="revenue-file" id="revenue-file-upload"
                                            style="display: none;" required>
                                        <input type="hidden" name="bg_id" value="{{ $project_id }}">

                                        <!-- Upload Button Triggers File Input -->
                                        <button type="button" class="btn btn-primary btn-custom"
                                            onclick="revenuetriggerFileUpload()">Upload</button>
                                    </form>

                                    <!-- Download Button -->
                                    <a href="{{ route('revenueplan-export', $project_id) }}"
                                        class="btn btn-primary btn-custom m-2">
                                        Download Excel
                                    </a>


                                </div>
                                @if ($budget->approval_status === 'pending')
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addNewRevenuePlan">ADD REVENUE</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Approved</button>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>PROJECT</th>
                                        <th>DESCRIPTION</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->revenuePlans as $revenuePlan)
                                        <tr>
                                            @php
                                                $project = $projects->where('id', $revenuePlan->project)->first();
                                            @endphp
                                            <td>{{ $revenuePlan->sn }}</td>
                                            <td>{{ $revenuePlan->type }}</td>
                                            <td>{{ $project->name ?? 'no entry' }}</td>
                                            <td>{{ $revenuePlan->description }}</td>
                                            <td>{{ number_format($revenuePlan->amount, 0) }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editRevenueModal" data-id="{{ $revenuePlan->id }}"
                                                    data-type="{{ $revenuePlan->type }}"
                                                    data-project="{{ $project->id }}"
                                                    data-description="{{ $revenuePlan->description }}"
                                                    data-amount="{{ $revenuePlan->amount }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Button -->
                                                <form
                                                    action="{{ route('delete-budget-project-revenue', $revenuePlan->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this revenue?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
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

<!-- Revenue Modal -->
<div class="modal fade" id="addNewRevenuePlan" tabindex="-1" aria-labelledby="addNewSalaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSalaryModalLabel">Add Revenue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewRevenueForm" action="{{ url('/pages/add-budget-project-revenue') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Revenue">Revenue</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select" id="project" name="project">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount_display" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount_display" placeholder="Enter amount"
                            value="{{ number_format($allocatedBudget->total_salary ?? 0, 0) }}" 
                            oninput="formatNumber(this, 'amount_hidden')" required>
                        <input type="hidden" id="amount_hidden" name="amount" 
                            value="{{ $allocatedBudget->total_salary ?? 0 }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required
                            placeholder="Enter description (e.g., NOC Payment)">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            placeholder="Enter status (e.g., Pending)">
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">

                    <button type="submit" class="btn btn-primary">Add Revenue</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Edit Revenue Model-->

<div class="modal fade" id="editRevenueModal" tabindex="-1" aria-labelledby="editRevenueModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRevenueModalLabel">Edit Revenue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-budget-project-revenue', 'id') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="revenueId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="revenueType" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-control" id="revenueProject" name="project">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="revenueDescription" name="description"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="revenueAmount_display" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="revenueAmount_display" placeholder="Enter amount"
                            value="" 
                            oninput="formatNumber(this, 'revenueAmount_hidden')" required>
                        <input type="hidden" id="revenueAmount_hidden" name="amount" value="">
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>
    document.addEventListener('DOMContentLoaded', function () {

// Function to format input with commas and store raw numeric value in hidden field
function formatNumber(input, hiddenFieldId) {
    // Remove non-numeric characters except decimal
    let value = input.value.replace(/[^0-9.]/g, '');

    if (value) {
        let parts = value.split('.');
        let integerPart = parseInt(parts[0] || '0').toLocaleString('en-US');
        let formattedValue = integerPart;

        if (parts[1] !== undefined) {
            formattedValue += '.' + parts[1].slice(0, 2); // Allow up to 2 decimal places
        }

        input.value = formattedValue;
        document.getElementById(hiddenFieldId).value = value.replace(/,/g, '');
    } else {
        input.value = '';
        document.getElementById(hiddenFieldId).value = '';
    }
}

// Add Revenue - Input Formatting
const addAmountInput = document.getElementById('amount_display');
addAmountInput.addEventListener('input', function () {
    formatNumber(this, 'amount_hidden');
});

// Edit Revenue - Input Formatting
const editAmountInput = document.getElementById('revenueAmount_display');
editAmountInput.addEventListener('input', function () {
    formatNumber(this, 'revenueAmount_hidden');
});

// Handle Add Revenue form submission - Remove commas before submission
document.getElementById('addNewRevenueForm').addEventListener('submit', function () {
    document.getElementById('amount_hidden').value = document.getElementById('amount_hidden').value.replace(/,/g, '');
});

// Handle Edit Revenue form submission - Remove commas before submission
document.querySelector('#editRevenueModal form').addEventListener('submit', function () {
    document.getElementById('revenueAmount_hidden').value = document.getElementById('revenueAmount_hidden').value.replace(/,/g, '');
});

// Handle Edit Revenue Modal pre-fill values
var editModal = document.getElementById('editRevenueModal');

editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;

    var id = button.getAttribute('data-id');
    var type = button.getAttribute('data-type');
    var project = button.getAttribute('data-project');
    var description = button.getAttribute('data-description');
    var amount = button.getAttribute('data-amount');

    document.getElementById('revenueId').value = id;
    document.getElementById('revenueType').value = type;
    document.getElementById('revenueProject').value = project;
    document.getElementById('revenueDescription').value = description;

    // Format and pre-fill amount field with commas
    var formattedAmount = parseFloat(amount.replace(/,/g, '')).toLocaleString('en-US', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    document.getElementById('revenueAmount_display').value = formattedAmount;
    document.getElementById('revenueAmount_hidden').value = amount.replace(/,/g, '');

    document.querySelector('#editRevenueModal form').setAttribute('action', `/pages/update-budget-project-revenue/${id}`);
});

// File Upload Handling
window.revenuetriggerFileUpload = function () {
    document.getElementById('revenue-file-upload').click();
};

document.getElementById('revenue-file-upload').addEventListener('change', function () {
    const overlay = document.getElementById('loading-overlay');
    overlay.style.display = 'flex'; // Show the spinner
    setTimeout(() => {
        document.getElementById('revenue-file-upload-form').submit(); // Submit form after delay
    }, 500);
});
});

</script>
