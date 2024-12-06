<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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

        /* Background and text color for Bank and Paid Amount columns */
        td:nth-child(4),
        th:nth-child(4),
        td:nth-child(6),
        th:nth-child(6) {
            background-color: #f0f8ff; /* Light blue background */
            color: black; /* White font color */
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
            <h5>Maxillion Real Estate</h5>
            <p>Payment Order No: PO291124-58N</p>
            <p>Date: 2024-11-29</p>
        </div>

        <form id="paymentForm" method="POST">
            <div class="table-responsive">
                <table id="paymentTable">
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
                                    <option value="1">Project A</option>
                                    <option value="2">Project B</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" name="head[]" required></td>
                            <td><input type="text" class="form-control" name="description[]" required></td>
                            <td>
                                <div class="bank-container">
                                    <!-- Dynamically populated bank payment fields will go here -->
                                </div>
                            </td>
                            <td><input type="number" class="form-control balance-field" name="balance[]" readonly></td>
                            <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]" readonly></td>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            const dummyData = {
                1: { balance: 61000, banks: [{ name: 'ADIB', balance: 50000 }, { name: 'ADCB', balance: 4000 }, { name: 'RAK', balance: 7000 }] },
                2: { balance: 30000, banks: [{ name: 'HSBC', balance: 15000 }, { name: 'Mashreq', balance: 15000 }] }
            };

            // Populate bank fields when a project is selected
            $(document).on('change', '.project-dropdown', function () {
                const row = $(this).closest('tr');
                const projectId = $(this).val();

                if (projectId && dummyData[projectId]) {
                    const projectData = dummyData[projectId];
                    const bankContainer = row.find('.bank-container');

                    // Clear previous bank entries
                    bankContainer.empty();

                    // Populate bank fields
                    projectData.banks.forEach(bank => {
                        const bankEntry = `
                            <div class="bank-entry">
                                <label>${bank.name} (${bank.balance}):</label>
                                <input type="number" class="form-control bank-payment" placeholder="Enter Payment Amount">
                            </div>
                        `;
                        bankContainer.append(bankEntry);
                    });

                    // Update total balance
                    row.find('.balance-field').val(projectData.balance);
                }
            });

            // Update total paid amount dynamically
            $(document).on('input', '.bank-payment', function () {
                const row = $(this).closest('tr');
                let totalPaid = 0;

                // Sum all entered amounts in the bank fields
                row.find('.bank-payment').each(function () {
                    totalPaid += parseFloat($(this).val()) || 0;
                });

                // Update the total paid amount field
                row.find('.total-paid-amount').val(totalPaid);
            });

            // Add a new row
            $('#addRow').on('click', function () {
                const newRow = $('#paymentTable tbody tr:first').clone();
                newRow.find('input, select').val('');
                newRow.find('.bank-container').empty();
                $('#paymentTable tbody').append(newRow);
            });

            // Remove a row
            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
</body>

</html>
