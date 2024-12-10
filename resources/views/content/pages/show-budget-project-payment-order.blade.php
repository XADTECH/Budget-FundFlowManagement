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
                                        required></td>
                                <td><input type="text" class="form-control" name="description[]"
                                        value="{{ $item['description'] }}" required></td>
                                <td>
                                    <div class="bank-container">
                                        @foreach ($item['banks'] as $bankId => $bankAmount)
                                        <div class="bank-entry">
                                            <label>{{ $banks->find($bankId)->bank_name ?? '' }}:</label>
                                            <input type="number" class="form-control bank-payment"
                                                name="bank_amount[{{ $index }}][{{ $bankId }}]"
                                                value="{{ is_scalar($bankAmount) ? $bankAmount : '' }}" step="0.01">
                                        </div>
                                    @endforeach
                                    </div>
                                </td>
                                <td><input type="number" class="form-control balance-field" name="balance[]"
                                        value="{{ $item['balance'] }}" readonly></td>
                                <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]"
                                        value="{{ $item['paid_amount'] }}" readonly></td>
                                <td><input type="text" class="form-control" name="beneficiary_name[]"
                                        value="{{ $item['beneficiary_name'] }}" required></td>
                                <td><input type="text" class="form-control" name="beneficiary_iban[]"
                                        value="{{ $item['beneficiary_iban'] }}" required></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                        @empty
                            <!-- If no items, show an empty row -->
                            <tr data-row-index="0">
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
                                <td><input type="number" class="form-control total-paid-amount" name="paid_amount[]"
                                        readonly></td>
                                <td><input type="text" class="form-control" name="beneficiary_name[]" required></td>
                                <td><input type="text" class="form-control" name="beneficiary_iban[]" required></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Submit Payment Order</button>
                <button type="button" id="addRow" class="btn btn-success ms-2">Add Item</button>
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
            $('.project-dropdown').select2({
                placeholder: "Select a project",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>

</html>
