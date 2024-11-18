@extends('layouts/contentNavbarLayout')

@section('title', 'Create Payment Order')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 20px;
    }

    .container {
        max-width: 90%;
        margin: auto;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h4 {
        color: #1a73e8;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
    }

    .btn-primary {
        background-color: #1a73e8;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #135ba3;
    }

    .table-container {
        margin-top: 20px;
        overflow-x: auto;
    }

    .payment-order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .payment-order-table th,
    .payment-order-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .payment-order-table th {
        background-color: #1a73e8;
        color: white;
    }

    .add-item-btn {
        margin-top: 20px;
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-item-btn:hover {
        background-color: #218838;
    }
</style>

<div class="container">
    <form action="" method="POST">
        @csrf
        <!-- Payment Order Details -->
        <div class="form-section">
            <h4>Payment Order Details</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="poNumber" class="form-label">Payment Order No.</label>
                    <input type="text" id="poNumber" name="po_number" class="form-control" placeholder="Enter PO Number" required>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="paymentTerm" class="form-label">Payment Term</label>
                    <input type="text" id="paymentTerm" name="payment_term" class="form-control" placeholder="e.g., Net 30" required>
                </div>
            </div>
        </div>

        <!-- Beneficiary Details -->
        <div class="form-section">
            <h4>Beneficiary Details</h4>
            <div class="row">
                <div class="col-md-6">
                    <label for="beneficiaryName" class="form-label">Beneficiary Name</label>
                    <input type="text" id="beneficiaryName" name="beneficiary_name" class="form-control" placeholder="Enter Beneficiary Name" required>
                </div>
                <div class="col-md-6">
                    <label for="iban" class="form-label">Beneficiary IBAN/Account</label>
                    <input type="text" id="iban" name="iban" class="form-control" placeholder="Enter IBAN/Account" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="bankName" class="form-label">Bank Name</label>
                    <input type="text" id="bankName" name="bank_name" class="form-control" placeholder="Enter Bank Name" required>
                </div>
                <div class="col-md-6">
                    <label for="paidTo" class="form-label">Paid To</label>
                    <input type="text" id="paidTo" name="paid_to" class="form-control" placeholder="Enter Paid To" required>
                </div>
            </div>
        </div>

        <!-- Payment Items -->
        <div class="form-section">
            <h4>Payment Items</h4>
            <div class="table-container">
                <table class="payment-order-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="paymentItems">
                        <!-- Rows will be added dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="add-item-btn" onclick="addItem()">+ Add Item</div>
        </div>

        <!-- Budget Summary -->
        <div class="form-section">
            <h4>Budget Summary</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="totalBudget" class="form-label">Total Budget</label>
                    <input type="text" id="totalBudget" name="total_budget" class="form-control" placeholder="Enter Total Budget" required>
                </div>
                <div class="col-md-4">
                    <label for="utilization" class="form-label">Utilization</label>
                    <input type="text" id="utilization" name="utilization" class="form-control" placeholder="Enter Utilization" required>
                </div>
                <div class="col-md-4">
                    <label for="balance" class="form-label">Balance</label>
                    <input type="text" id="balance" name="balance" class="form-control" placeholder="Enter Balance" required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Submit Payment Order</button>
        </div>
    </form>
</div>

<script>
    // Dynamically add items to the payment order
    function addItem() {
        const tableBody = document.getElementById('paymentItems');
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="text" name="item_description[]" class="form-control" placeholder="Enter Description" required></td>
            <td><input type="number" name="item_amount[]" class="form-control" placeholder="Enter Amount" required></td>
            <td>
                <select name="item_status[]" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </td>
            <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
        `;

        tableBody.appendChild(row);
    }

    // Remove an item from the table
    function removeItem(button) {
        button.closest('tr').remove();
    }
</script>

@endsection
