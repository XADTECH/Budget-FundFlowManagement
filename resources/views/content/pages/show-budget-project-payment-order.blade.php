<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
        }

        .upload-doc-btn {
            background-color: #17a2b8;
            /* Info color */
            color: #ffffff;
            /* White text */
            border: none;
            /* Remove border */
            border-radius: 2px;
            /* Slightly rounded corners */
            font-size: 10px;
            /* Smaller text for compact look */
            padding: 6px 12px;
            /* Compact padding */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            display: block;
            /* Make button a block element */
            margin: 0 auto;
            /* Center horizontally */
            text-align: center;
            /* Center text inside the button */
            transition: background-color 0.3s ease;
            /* Smooth hover effect */
            width: auto;
            /* Automatically adjust width to content */
            height: auto;
            /* Automatically adjust height */
        }

        .upload-doc-btn:hover {
            background-color: #138496;
            /* Slightly darker shade on hover */
            cursor: pointer;
        }

        .upload-doc-btn i {
            font-size: 12px;
            /* Adjust icon size to match smaller button */
        }

        .processed-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            background-color: #6c757d;
            /* Gray color */
            color: #ffffff;
            cursor: not-allowed;
        }

        .processed-btn span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            background-color: white;
            color: green;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
            /* Add space between text and tick */
        }

        .container-fluid {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 1.4rem;
            color: #005d77;
            font-weight: bold;
        }

        .container-fluid p {
            font-size: 0.95rem;
            color: #7d7d7d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
            padding: 12px 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0067aa;
            color: #fff;
            font-weight: bold;
        }

        .form-control,
        .form-select {
            font-size: 0.85rem;
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0067aa;
            box-shadow: 0 0 5px rgba(0, 103, 170, 0.5);
        }

        .btn {
            font-size: 0.85rem;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #0067aa;
            border-color: #005f8c;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #c82333;
        }

        .bank-container {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 6px;
        }

        .bank-entry {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .bank-entry label {
            flex: 1;
            font-size: 0.85rem;
            color: #495057;
        }

        .bank-entry input {
            flex: 2;
            font-size: 0.85rem;
            border-radius: 4px;
            padding: 8px;
        }

        .remove-row {
            font-size: 0.8rem;
            padding: 5px 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            th,
            td {
                font-size: 0.8rem;
                padding: 8px;
            }

            .btn {
                font-size: 0.75rem;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <!-- Back Button -->
        <div class="mb-3">
            <button class="btn btn-secondary" onclick="history.back()">Back</button>
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
        <div class="text-center mb-4"
            style="font-family: Arial, sans-serif; color: #333; padding: 10px; border-bottom: 1px solid #ccc;">
            <h5 class="header-title" style="font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">
                {{ $po->company_name }}
            </h5>
            <p style="font-size: 0.9rem; margin: 3px 0;">
                <strong>Payment Order No:</strong> {{ $po->payment_order_number }}
            </p>
            <p style="font-size: 0.9rem; margin: 3px 0;">
                <strong>Date:</strong> {{ $po->payment_date }}
            </p>
            <p style="font-size: 0.9rem; margin: 3px 0;">
                <strong>Currency:</strong> {{ $po->currency }}
            </p>
        </div>


        <form id="paymentForm" method="POST" action="{{ route('PaymentOrderItems.store') }}">
            @csrf
            <div class="table-responsive">
                <table id="paymentTable" class="table">
                    <thead>
                        <tr style="background: #005f8c">
                            <th>Project</th>
                            <th>Head</th>
                            <th>Description</th>
                            <th>Bank</th>
                            <th>Balance</th>
                            <th>Paid Amount</th>
                            <th>Beneficiary Name</th>
                            <th>Beneficiary IBAN/Account</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through existing items -->
                        @forelse ($items as $index => $item)
                            <tr data-row-index="{{ $index }}">
                                <td>
                                    <select class="form-select project-dropdown" name="projectname[]"
                                        @if (isset($item['budget_project_id'])) disabled @endif>
                                        @foreach ($budgets as $project)
                                            <option value="{{ $project->id }}"
                                                {{ $project->id == $item['budget_project_id'] ? 'selected' : '' }}>
                                                {{ $project->reference_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="head[]"
                                        value="{{ $item['head'] }}" readonly></td>
                                <td><input type="text" class="form-control" name="description[]"
                                        value="{{ $item['description'] }}" readonly></td>
                                <td>
                                    <div class="bank-container">
                                        @foreach ($item['banks'] as $bank)
                                            <div class="bank-entry">
                                                <label>
                                                    {{ $banks->find($bank['bank_id'])->bank_name ?? '' }}:
                                                    <span class="bank-balance" id="balance-{{ $bank['bank_id'] }}">
                                                        <!-- This will dynamically show the balance -->
                                                        (Loading...)
                                                    </span>
                                                </label>
                                                <input type="number" class="form-control bank-payment"
                                                    name="bank_amount[{{ $index }}][{{ $bank['bank_id'] }}]"
                                                    value="{{ $bank['amount'] }}" step="0.01" readonly>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td><input type="number" class="form-control balance-field" name="balance[]"
                                        value="{{ $item['balance'] }}" readonly></td>
                                <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]"
                                        value="{{ $item['paid_amount'] }}" readonly></td>
                                <td><input type="text" class="form-control" name="beneficiary_name[]"
                                        value="{{ $item['beneficiary_name'] }}" readonly></td>
                                <td><input type="text" class="form-control" name="beneficiary_iban[]"
                                        value="{{ $item['beneficiary_iban'] }}" readonly></td>
                                <td>
                                    <div class="d-flex flex-column justify-content-start align-items-center gap-2">
                                        <!-- Remove Button -->
                                        @if ($po->submit_status === 'Submitted')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                disabled>Remove</button>
                                        @else
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        @endif

                                        <!-- Process Button -->
                                        <form method="POST" action="{{ route('processItem') }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="budget_project_id"
                                                value="{{ $item['budget_project_id'] }}">
                                            <input type="hidden" name="head" value="{{ $item['head'] }}">
                                            <input type="hidden" name="description"
                                                value="{{ $item['description'] }}">
                                            <input type="hidden" name="paid_amount"
                                                value="{{ $item['paid_amount'] }}">
                                            <input type="hidden" name="beneficiary_name"
                                                value="{{ $item['beneficiary_name'] }}">
                                            <input type="hidden" name="beneficiary_iban"
                                                value="{{ $item['beneficiary_iban'] }}">
                                            <input type="hidden" name="processed" value="{{ $item['processed'] }}">

                                            <!-- Process Button -->
                                            <button type="submit"
                                                class="btn btn-sm {{ $item['processed'] ? 'btn-secondary' : 'btn-success' }} processed-btn"
                                                {{ $item['processed'] || $po->status !== 'approved' ? 'disabled' : '' }}>
                                                {{ $item['processed'] ? 'Processed' : 'Process' }}
                                                @if ($item['processed'])
                                                    <span class="ms-1 d-flex justify-content-center align-items-center"
                                                        style="width: 16px; height: 16px; background-color: white; color: green; border-radius: 50%; font-size: 12px; font-weight: bold;">
                                                        ✓
                                                    </span>
                                                @endif
                                            </button>
                                        </form>

                                        <!-- Upload Documents Button -->
                                        <button type="button" class="upload-doc-btn" data-bs-toggle="modal"
                                            data-bs-target="#uploadModal-{{ $index }}">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="uploadModal-{{ $index }}" tabindex="-1"
                                            aria-labelledby="uploadModalLabel-{{ $index }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                style="max-width: 60%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="uploadModalLabel-{{ $index }}">Upload Documents
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('paymentOrders.uploadDocument') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="budget_project_id"
                                                                value="{{ $item['budget_project_id'] }}">
                                                            <input type="hidden" name="head"
                                                                value="{{ $item['head'] }}">
                                                            <input type="hidden" name="description"
                                                                value="{{ $item['description'] }}">
                                                            <div class="mb-3">
                                                                <label for="uploadFile-{{ $index }}"
                                                                    class="form-label">Choose File</label>
                                                                <input class="form-control" type="file"
                                                                    id="uploadFile-{{ $index }}"
                                                                    name="document"
                                                                    accept=".pdf,.png,.jpg,.jpeg,.xls,.xlsx" required>
                                                            </div>
                                                            <div class="text-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- If no items, show an empty row -->
                            <tr data-row-index="0">
                                <td>
                                    <select class="form-select project-dropdown" name="projectname[]">
                                        <option value="" selected disabled>Select a project</option>
                                        @foreach ($budgets as $project)
                                            <option value="{{ $project->id }}">{{ $project->reference_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="head[]" required></td>
                                <td><input type="text" class="form-control" name="description[]" required></td>
                                <td>
                                    <div class="bank-container"></div>
                                </td>
                                <td><input type="number" class="form-control balance-field" name="balance[]">
                                </td>
                                <td><input type="number" class="form-control total-paid-amount"
                                        name="paid_amount[]">
                                </td>
                                <td><input type="text" class="form-control" name="beneficiary_name[]" required>
                                </td>
                                <td><input type="text" class="form-control" name="beneficiary_iban[]" required>
                                </td>
                                <td>
                                    @if (!$po->is_submitted)
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-row">Remove</button>

                                        <button type="button" class="upload-doc-btn mt-2">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>


                                        <!-- Modal for Upload -->

                                        <div class="modal fade" id="uploadModal" tabindex="-1"
                                            aria-labelledby="uploadModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                style="max-width: 60%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="uploadModalLabel">Upload Documents
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <p><strong>Selected Projects:</strong></p>
                                                            <div id="selectedProjectsPreview"
                                                                class="border rounded p-3"
                                                                style="max-height: 200px; overflow-y: auto;">
                                                                <p class="text-muted">No projects selected yet.</p>
                                                            </div>
                                                        </div>
                                                        <form id="uploadForm" method="POST"
                                                            action="{{ route('paymentOrders.uploadDocument') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div id="selectedProjectsInputs"></div>
                                                            <!-- Dynamically add hidden inputs for selected projects -->
                                                            <div class="mb-3">
                                                                <label for="uploadFile" class="form-label">Choose
                                                                    Files</label>
                                                                <input class="form-control" type="file"
                                                                    id="uploadFile" name="documents[]" multiple
                                                                    accept=".pdf,.png,.jpg,.jpeg,.xls,.xlsx">
                                                            </div>
                                                            <div id="filePreviewContainer" class="mt-3">
                                                                <p class="text-muted">No files selected yet.</p>
                                                            </div>
                                                            <div class="text-end mt-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                @if ($po->submit_status == 'Submitted')
                    <button type="button" class="btn btn-success d-flex align-items-center" id="proceedPayment"
                        @if ($po->status == 'pending') disabled @endif>
                        Proceed All
                        <span class="ms-2 d-flex justify-content-center align-items-center"
                            style="width: 20px; height: 20px; background-color: white; color: green; border-radius: 50%; font-size: 14px; font-weight: bold;">
                            ✓
                        </span>
                    </button>
                    @if ($po->paid_status !== 'not paid yet')
                        <button type="button" class="btn btn-primary" id="downloadPDF">
                            Download PDF
                        </button>
                    @endif
                @else
                    <button type="submit" class="btn btn-primary">Submit Payment Order</button>
                    <button type="button" id="addRow" class="btn btn-success ms-2">Add Item</button>
                @endif
            </div>

            <input type="hidden" name="payment_order_id" value="{{ $po->id }}" />
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.project-dropdown').select2({
                placeholder: "Select a project",
                allowClear: true,
                width: '100%'
            });
            // Pass the budgets data to JavaScript
            const budgets = @json($budgets);

            $(document).on('click', '.upload-doc-btn', function() {
                const row = $(this).closest('tr');
                const projectDropdown = row.find('.project-dropdown');
                const selectedProjectId = projectDropdown.val();

                if (selectedProjectId) {
                    // Find the project details
                    const selectedProject = budgets.find(budget => budget.id == selectedProjectId);

                    if (selectedProject) {
                        const previewContainer = $('#selectedProjectsPreview');
                        const inputsContainer = $('#selectedProjectsInputs');

                        // Prevent duplicate entries
                        if (!inputsContainer.find(`input[value="${selectedProjectId}"]`).length) {
                            // Add a preview entry
                            previewContainer.append(`
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <p class="mb-0"><strong>${selectedProject.reference_code}</strong> (${selectedProject.region} - ${selectedProject.site_name})</p>
                        <button type="button" class="btn btn-sm btn-danger remove-project" data-project-id="${selectedProjectId}">Remove</button>
                    </div>
                `);

                            // Add a hidden input for the project
                            inputsContainer.append(`
                    <input type="hidden" name="budget_project_ids[]" value="${selectedProjectId}">
                `);

                            // Remove "No projects selected yet" placeholder
                            previewContainer.find('.text-muted').remove();
                        }

                        // Open the modal
                        $('#uploadModal').modal('show');
                    } else {
                        alert('Selected project not found in the budget list.');
                    }
                } else {
                    alert('Please select a project first.');
                }
            });

            $(document).on('change', '#uploadFile', function() {
                const files = this.files; // Get selected files
                const previewContainer = $('#filePreviewContainer');

                previewContainer.empty(); // Clear previous previews

                if (files.length === 0) {
                    previewContainer.html('<p class="text-muted">No files selected yet.</p>');
                    return;
                }

                // Loop through the selected files
                Array.from(files).forEach((file, index) => {
                    const fileName = file.name;
                    const fileType = file.type;

                    const fileTypeIcon = getFileTypeIcon(fileType);

                    const filePreview = `
            <div class="d-flex align-items-center justify-content-between border p-2 rounded mb-2">
                <div class="d-flex align-items-center">
                    <span class="me-2">${fileTypeIcon}</span>
                    <p class="mb-0">${fileName}</p>
                </div>
                <button type="button" class="btn btn-sm btn-danger remove-file-btn" data-index="${index}">Remove</button>
            </div>
        `;
                    previewContainer.append(filePreview);
                });
            });

            // Function to map file types to icons
            function getFileTypeIcon(fileType) {
                if (fileType.includes('pdf')) return '<i class="fas fa-file-pdf text-danger"></i>';
                if (fileType.includes('excel') || fileType.includes('spreadsheet'))
                return '<i class="fas fa-file-excel text-success"></i>';
                if (fileType.includes('image')) return '<i class="fas fa-file-image text-primary"></i>';
                return '<i class="fas fa-file-alt text-secondary"></i>';
            }

            // Remove selected file from the input and preview
            $(document).on('click', '.remove-file-btn', function() {
                const fileIndex = $(this).data('index');
                const fileInput = $('#uploadFile')[0];
                const dt = new DataTransfer();

                // Re-add all files except the one being removed
                Array.from(fileInput.files).forEach((file, index) => {
                    if (index !== fileIndex) {
                        dt.items.add(file);
                    }
                });

                fileInput.files = dt.files; // Update the file input's files
                $(this).closest('.d-flex').remove(); // Remove the preview entry

                // Show "No files selected" if no files are left
                if (fileInput.files.length === 0) {
                    $('#filePreviewContainer').html('<p class="text-muted">No files selected yet.</p>');
                }
            });




            // Fetch and load bank details when a project is selected
            function loadBankDetails(row, projectId) {
                const bankContainer = row.find('.bank-container');

                $.ajax({
                    url: "{{ route('getBankDetails') }}",
                    method: "POST",
                    data: {
                        project_id: projectId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        bankContainer.empty();

                        // Populate bank balances and existing amounts (if available)
                        response.forEach((bank) => {
                            const bankEntry = `
                        <div class="bank-entry">
                            <label>${bank.name} (Balance: ${bank.project_balance}):</label>
                            <input type="number" class="form-control bank-payment"
                                name="bank_amount[${row.data('row-index')}][${bank.bank_id}]"
                                value="${bank.amount || ''}" step="0.01" >
                        </div>`;
                            bankContainer.append(bankEntry);
                        });

                        // Update total balance for the row
                        const totalBalance = response.reduce((sum, bank) => sum + parseFloat(bank
                            .project_balance || 0), 0);
                        row.find('.balance-field').val(totalBalance);
                    },
                    error: function() {
                        alert('Failed to fetch bank details. Please try again.');
                    }
                });
            }

            // Handle project dropdown change for fetching bank details
            $(document).on('change', '.project-dropdown', function() {
                const row = $(this).closest('tr');
                const projectId = $(this).val();

                if (projectId) {
                    loadBankDetails(row, projectId);
                } else {
                    row.find('.bank-container').empty();
                    row.find('.balance-field').val('');
                }
            });

            // Add new row functionality
            $('#addRow').on('click', function() {
                const rowIndex = $('#paymentTable tbody tr').length;
                const newRow = `
                    <tr data-row-index="${rowIndex}">
                        <td>
                            <select class="form-select project-dropdown" name="projectname[]">
                                <option value="" selected disabled>Select a project</option>
                                @foreach ($budgets as $project)
                                    <option value="{{ $project->id }}">{{ $project->reference_code }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="head[]" required></td>
                        <td><input type="text" class="form-control" name="description[]" required></td>
                        <td>
                            <div class="bank-container"></div>
                        </td>
                        <td><input type="number" class="form-control balance-field" name="balance[]" ></td>
                        <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]" ></td>
                        <td><input type="text" class="form-control" name="beneficiary_name[]" required></td>
                        <td><input type="text" class="form-control" name="beneficiary_iban[]" required></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                     <button type="button" class="upload-doc-btn mt-2">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                        </td>
                    </tr>`;
                $('#paymentTable tbody').append(newRow);

                $('.project-dropdown').last().select2({
                    placeholder: "Select a project",
                    allowClear: true,
                    width: '100%'
                });
            });



            // Remove row functionality
            $(document).on('click', '.remove-row', function() {
                const rows = $('#paymentTable tbody tr');
                if (rows.length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            });

            // Calculate total paid amount dynamically
            $(document).on('input', '.bank-payment', function() {
                const row = $(this).closest('tr');
                let totalPaid = 0;

                // Sum all bank-payment fields in the current row
                row.find('.bank-payment').each(function() {
                    const amount = parseFloat($(this).val()) ||
                        0; // Default to 0 if the input is empty or invalid
                    totalPaid += amount;
                });

                // Update the total-paid-amount field
                row.find('.total-paid-amount').val(totalPaid.toFixed(
                    0)); // Ensure the value is formatted to two decimals
            });

            // Proceed payment and download PDF
            $('#proceedPayment').on('click', function() {
                alert('Proceed to payment logic goes here.');
            });

            $('#downloadPDF').on('click', function() {
                window.location.href = "{{ route('paymentOrder.downloadPDF', $po->id) }}";
            });

            // Fetch the balance for each bank when the page loads
            @foreach ($items as $index => $item)
                @if (isset($item['banks']) && count($item['banks']) > 0)
                    @foreach ($item['banks'] as $bank)
                        $.ajax({
                            url: '/get-bank-balance/' + {{ $bank['bank_id'] }},
                            method: 'GET',
                            success: function(response) {
                                // Update the balance display in the corresponding span element
                                $('#balance-{{ $bank['bank_id'] }}').text('(' + response + ')');
                            },
                            error: function() {
                                alert('Failed to fetch balance for bank ID: {{ $bank['bank_id'] }}');
                            }
                        });
                    @endforeach
                @endif
            @endforeach
        });
    </script>
</body>

</html>
