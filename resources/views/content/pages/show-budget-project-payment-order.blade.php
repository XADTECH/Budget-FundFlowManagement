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

        #pdfPreviewContainer {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
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
                        <input type="text" id="poNumber" name="po_number" class="form-control"
                            placeholder="Enter PO Number" value="{{ $po->payment_order_number ?? 'No Value' }}" required>
                    </div>
                    {{-- <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div> --}}

                </div>
            </div>

            <!-- Beneficiary Details -->

            @if ($po->payment_method === 'cash')
                <!-- Cash -->
                <div id="cashFields" class="form-section">
                    <h4>Cash Payment Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cashReceivedBy" class="form-label">Received By</label>
                            <input type="text" id="cashReceivedBy" name="cash_received_by" class="form-control"
                                placeholder="Enter Receiver's Name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cashDate" class="form-label">Payment Date</label>
                            <input type="date" id="cashDate" name="cash_date" class="form-control" required>
                        </div>
                    </div>
                </div>
            @elseif($po->payment_method === 'online transaction')
                <!-- Online Transaction -->
                <div id="onlineTransactionFields" class="form-section">
                    <h4>Online Transaction Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="transaction_number" class="form-label">Transaction Number</label>
                            <input type="text" id="transaction_number" name="transaction_id" class="form-control"
                                placeholder="Enter Transaction ID" required>
                        </div>
                        <div class="col-md-6">
                            <label for="transaction_detail" class="form-label">Transaction Detail</label>
                            <textarea id="transaction_detail" name="payment_gateway" class="form-control" placeholder="Please enter detail..."
                                required></textarea>
                        </div>
                    </div>
                </div>
            @elseif($po->payment_method === 'cheque')
                <!-- Cheque -->
                <div id="chequeFields" class="form-section">
                    <h4>Cheque Payment Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="chequeNumber" class="form-label">Cheque Number</label>
                            <input type="text" id="chequeNumber" name="cheque_number" class="form-control"
                                placeholder="Enter Cheque Number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="chequeDate" class="form-label">Cheque Date</label>
                            <input type="date" id="chequeDate" name="cheque_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="chequeFile" class="form-label">Upload Cheque (PDF)</label>
                            <input type="file" id="chequeFile" name="cheque_file" class="form-control"
                                accept="application/pdf" onchange="previewPDF(event)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="chequePayee" class="form-label">Payee Name</label>
                            <input type="text" id="chequePayee" name="cheque_payee" class="form-control"
                                placeholder="Enter Payee Name" required>
                        </div>
                    </div>

                    <!-- PDF Preview Section -->
                    <div id="pdfPreviewContainer" class="mt-4 d-none">
                        <h5>PDF Preview:</h5>
                        <embed id="pdfPreview" src="" type="application/pdf" width="100%" height="400px" />
                    </div>
                </div>
        @elseif($po->payment_method === 'bank transfer')
            <!-- Bank Transfer -->
            <div id="bankTransferFields" class="form-section">
                <h4>Bank Transfer Details</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="beneficiaryName" class="form-label">Beneficiary Name</label>
                        <input type="text" id="beneficiaryName" name="beneficiary_name" class="form-control"
                            placeholder="Enter Beneficiary Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="iban" class="form-label">IBAN/Account Number</label>
                        <input type="text" id="iban" name="iban" class="form-control"
                            placeholder="Enter IBAN/Account" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="bankName" class="form-label">Bank Name</label>
                        <input type="text" id="bankName" name="bank_name" class="form-control"
                            placeholder="Enter Bank Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="paidTo" class="form-label">Paid To</label>
                        <input type="text" id="paidTo" name="paid_to" class="form-control"
                            placeholder="Enter Paid To" required>
                    </div>
                </div>
            </div>
        @else
            <p class="text-muted">Please select a valid payment method to see relevant fields.</p>
            @endif


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
                        <input type="text" id="totalBudget" name="total_budget" class="form-control"
                            placeholder="Enter Total Budget" required>
                    </div>
                    <div class="col-md-4">
                        <label for="utilization" class="form-label">Utilization</label>
                        <input type="text" id="utilization" name="utilization" class="form-control"
                            placeholder="Enter Utilization" required>
                    </div>
                    <div class="col-md-4">
                        <label for="balance" class="form-label">Balance</label>
                        <input type="text" id="balance" name="balance" class="form-control"
                            placeholder="Enter Balance" required>
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

        function previewPDF(event) {
            const file = event.target.files[0];
            if (file && file.type === "application/pdf") {
                const fileURL = URL.createObjectURL(file); // Generate a URL for the uploaded file
                document.getElementById('pdfPreview').src = fileURL; // Set the src of the embed element
                document.getElementById('pdfPreviewContainer').classList.remove('d-none'); // Show the preview container
            } else {
                alert("Please upload a valid PDF file.");
                document.getElementById('chequeFile').value = ""; // Reset the input field if the file is invalid
                document.getElementById('pdfPreviewContainer').classList.add('d-none'); // Hide the preview container
            }
        }


        // Remove an item from the table
        function removeItem(button) {
            button.closest('tr').remove();
        }
    </script>

@endsection
