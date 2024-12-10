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

        <div class="text-center mb-4">
            <h5 class="header-title">{{ $po->company_name }}</h5>
            <p>Payment Order No: {{ $po->payment_order_number }}</p>
            <p>Date: {{ $po->payment_date }}</p>
        </div>

        <form id="paymentForm" method="POST" action="{{ route('paymentOrders.store') }}">
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
                        <tr>
                            <td>
                                <select class="form-select project-dropdown" name="projectname[]">
                                    <option disabled selected value>Choose</option>
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
                            <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]"
                                    readonly></td>
                            <td><input type="text" class="form-control" name="beneficiary_name[]" required></td>
                            <td><input type="text" class="form-control" name="beneficiary_iban[]" required></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Submit Payment Order</button>
                <button type="button" id="addRow" class="btn btn-success ms-2">Add Item</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for the project dropdown
            $('.project-dropdown').select2({
                placeholder: "Select a project",
                allowClear: true,
                width: '100%'
            });

            $(document).on('change', '.project-dropdown', function() {
                const row = $(this).closest('tr');
                const projectId = $(this).val();
                const bankContainer = row.find('.bank-container');

                if (projectId) {
                    $.ajax({
                        url: "{{ route('getBankDetails') }}", // Route to fetch total amount
                        method: "POST",
                        data: {
                            project_id: projectId, // Pass the selected project ID
                            _token: "{{ csrf_token() }}" // CSRF token for security
                        },
                        success: function(response) {
                            bankContainer.empty(); // Clear previous bank details

                            response.forEach(bank => {
                                const bankEntry = `
                        <div class="bank-entry">
                            <label>${bank.name} (${bank.project_balance}):</label>
                            <input type="number" class="form-control bank-payment" placeholder="Enter Payment Amount" step="0.01">
                        </div>`;
                                bankContainer.append(bankEntry);
                            });

                            // Calculate the total balance and display in the balance field
                            const totalBalance = response.reduce((sum, bank) => sum + bank
                                .balance, 0);
                            row.find('.balance-field').val(totalBalance);
                        },
                        error: function() {
                            alert('Failed to fetch data. Please try again.');
                        }
                    });
                } else {
                    bankContainer.empty(); // Clear bank container if no project is selected
                    row.find('.balance-field').val('');
                }
            });


            // Add new row
            $('#addRow').on('click', function() {
                const newRow = $('#paymentTable tbody tr:first').clone();
                newRow.find('input, select').val('');
                newRow.find('.bank-container').empty();
                $('#paymentTable tbody').append(newRow);

                newRow.find('.project-dropdown').select2({
                    placeholder: "Select a project",
                    allowClear: true,
                    width: '100%'
                });
            });

            // Remove row
            $(document).on('click', '.remove-row', function() {
                const rows = $('#paymentTable tbody tr');
                if (rows.length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            });
        });
    </script>
</body>

</html>
