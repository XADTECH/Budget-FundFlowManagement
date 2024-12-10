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
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        .form-control,
        .form-select {
            width: 100%;
            box-sizing: border-box;
        }

        .bank-container {
            padding: 5px;
        }

        .bank-entry {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .bank-entry label {
            flex: 1;
        }

        .bank-entry input {
            flex: 2;
            margin-left: 5px;
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

        <div class="text-center mb-4">
            <h5 class="header-title">{{ $po->company_name }}</h5>
            <p>Payment Order No: {{ $po->payment_order_number }}</p>
            <p>Date: {{ $po->payment_date }}</p>
        </div>

        <form id="paymentForm" method="POST" action="{{ route('PaymentOrderItems.store') }}">
            @csrf
            <div class="table-responsive">
                <table id="paymentTable" class="table">
                    <thead>
                        <tr>
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
                                    <select class="form-select project-dropdown" name="projectname[]">
                                        @foreach ($budgets as $project)
                                            <option value="{{ $project->id }}"
                                                {{ $project->id == $item['budget_project_id'] ? 'selected' : '' }}>
                                                {{ $project->reference_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="head[]" value="{{ $item['head'] }}"
                                    readonly></td>
                                <td><input type="text" class="form-control" name="description[]"
                                        value="{{ $item['description'] }}" readonly></td>
                                <td>
                                    <div class="bank-container">
                                        @foreach ($item['banks'] as $bank)
                                            <div class="bank-entry">
                                                <label>{{ $banks->find($bank['bank_id'])->bank_name ?? '' }}:</label>
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
                                    @if (!$po->is_submitted)
                                        <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                    @endif
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
                                <td><input type="number" class="form-control balance-field" name="balance[]" readonly>
                                </td>
                                <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]"
                                        readonly></td>
                                <td><input type="text" class="form-control" name="beneficiary_name[]" required></td>
                                <td><input type="text" class="form-control" name="beneficiary_iban[]" required></td>
                                <td>
                                    @if (!$po->is_submitted)
                                        <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                @if ($po->submit_status === 'submitted')
                    <button type="button" class="btn btn-success" id="proceedPayment">Proceed Payment</button>
                    <button type="button" class="btn btn-primary" id="downloadPDF">Download PDF</button>
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
        $(document).ready(function () {
            // Initialize Select2
            $('.project-dropdown').select2({
                placeholder: "Select a project",
                allowClear: true,
                width: '100%'
            });

            // Fetch and load bank details when a project is selected
            $(document).on('change', '.project-dropdown', function () {
                const row = $(this).closest('tr');
                const projectId = $(this).val();
                const bankContainer = row.find('.bank-container');
                const currentRowIndex = row.data('row-index');

                if (projectId) {
                    $.ajax({
                        url: "{{ route('getBankDetails') }}",
                        method: "POST",
                        data: {
                            project_id: projectId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            bankContainer.empty();
                            response.forEach((bank) => {
                                const bankEntry = `
                                    <div class="bank-entry">
                                        <label>${bank.name} (${bank.project_balance}):</label>
                                        <input type="number" class="form-control bank-payment"
                                            name="bank_amount[${currentRowIndex}][${bank.bank_id}]"
                                            placeholder="Enter Payment Amount" step="0.01">
                                    </div>`;
                                bankContainer.append(bankEntry);
                            });

                            const totalBalance = response.reduce((sum, bank) => sum + bank.project_balance, 0);
                            row.find('.balance-field').val(totalBalance);
                        },
                        error: function () {
                            alert('Failed to fetch bank details. Please try again.');
                        }
                    });
                } else {
                    bankContainer.empty();
                    row.find('.balance-field').val('');
                }
            });

            // Add new row functionality
            $('#addRow').on('click', function () {
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
                        <td><input type="number" class="form-control balance-field" name="balance[]" readonly></td>
                        <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]" readonly></td>
                        <td><input type="text" class="form-control" name="beneficiary_name[]" required></td>
                        <td><input type="text" class="form-control" name="beneficiary_iban[]" required></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
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
            $(document).on('click', '.remove-row', function () {
                const rows = $('#paymentTable tbody tr');
                if (rows.length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            });

                // Calculate total paid amount dynamically
    $(document).on('input', '.bank-payment', function () {
        const row = $(this).closest('tr');
        let totalPaid = 0;

        // Sum all bank-payment fields in the current row
        row.find('.bank-payment').each(function () {
            const amount = parseFloat($(this).val()) || 0; // Default to 0 if the input is empty or invalid
            totalPaid += amount;
        });

        // Update the total-paid-amount field
        row.find('.total-paid-amount').val(totalPaid.toFixed(0)); // Ensure the value is formatted to two decimals
    });

            // Proceed payment and download PDF
            $('#proceedPayment').on('click', function () {
                alert('Proceed to payment logic goes here.');
            });

            $('#downloadPDF').on('click', function () {
                window.location.href = "{{ route('paymentOrder.downloadPDF', $po->id) }}";
            });
        });
    </script>
</body>

</html>
