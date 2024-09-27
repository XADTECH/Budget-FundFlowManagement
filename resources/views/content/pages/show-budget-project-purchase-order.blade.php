@extends('layouts/contentNavbarLayout')

@section('title', 'Project Budgeting - summary')

@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }

        .container {
            max-width: 80%;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header,
        .footer {
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .purchase-order-title {
            text-align: right;
            color: #1a73e8;
        }

        .purchase-order-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .purchase-order-table th,
        .purchase-order-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .purchase-order-table th {
            background-color: #1a73e8;
            color: white;
        }

        .budget-verification-box {
            width: 100%;
            max-width: 500px;
            max-height: 350px;
            border: 2px solid #1a73e8;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            position: relative;
            background-color: #fff;
        }

        .budget-verification-box h5 {
            color: #1a73e8;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            position: absolute;
            top: -18px;
            background-color: white;
            padding: 0 10px;
        }

        .budget-verification-box table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .budget-verification-box td {
            padding: 5px;
            border: none;
            text-align: left;
            font-size: 14px;
        }

        .budget-verification-box .label {
            text-align: left;
            padding-right: 20px;
        }

        .budget-verification-box .value {
            text-align: right;
            border: 1px solid #1a73e8;
            padding: 3px;
            width: 100px;
        }

        .signature-box {
            margin-top: 20px;
            width: 100%;
        }

        .signature-box td {
            padding: 5px;
            font-size: 14px;
            text-align: left;
            width: 50%;
            border-top: 1px solid #000;
        }

        .signature-box .signature-line {
            border-bottom: 1px solid #000;
        }

        /* Responsive table container */
        .table-container {
            overflow-x: auto;
        }

        .custom-modal-body {
            max-height: 450px;
            overflow-y: auto;
            scrollbar-width: thin;
            /* Firefox */
            scrollbar-color: #0067aa #f1f1f1;
            /* Firefox: color for scrollbar thumb and track */
        }

        /* For WebKit browsers (Chrome, Safari) */
        .custom-modal-body::-webkit-scrollbar {
            width: 6px;
            /* Slim width for scrollbar */
        }

        .custom-modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Background of the scrollbar track */
        }

        .custom-modal-body::-webkit-scrollbar-thumb {
            background-color: #0067aa;
            /* Scrollbar thumb color to match table header */
            border-radius: 10px;
            /* Round scrollbar thumb edges */
            border: 2px solid #f1f1f1;
            /* Create space between the thumb and track */
        }

        .custom-modal-body::-webkit-scrollbar-thumb:hover {
            background-color: #004a7a;
            /* Darker blue on hover */
        }
    </style>
    </head>

    <body>

        <div class="container">
            <!-- Download Button -->
            <div class="text-end mt-4">
                @if ($purchaseOrder->status == 'submitted')
                    <a href="{{ route('download.pdf', ['POID' => $purchaseOrder->po_number]) }}" target="_blank" class="btn"
                        style="background-color:#1a73e8; color:white">
                        <i class="fas fa-print"></i> Download PDF
                    </a>
                @endif
            </div>
            <div class="header d-flex flex-column flex-md-row justify-content-between bg-white p-3 rounded">
                <div class="d-flex flex-column">
                    <h4>Xad Technologies LLC</h4>
                    <span>Office 1308, Opal Tower Business Bay, Dubai</span>
                    <span>TRN: 100293391400003</span>
                    <span>Email: admin@xadtech.com</span>
                    <span>Mobile: 054-7104301</span>
                    <span>Website: www.xadtechnologies.com</span>
                </div>
                <div class="purchase-order-title mt-3 mt-md-0">
                    <h2>PURCHASE ORDER</h2>
                    <div class="budget-verification-box bg-transparent;" style="border:2px solid black">
                        <table style="text-align:left" style="border:1px solid black">
                            <tr style="border:2px solid black; color;black">
                                <td class="label" style="color:black; border:1px solid black">Date :</td>
                                <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">
                                    {{ $purchaseOrder->date }}</td>
                            </tr>
                            <tr style="border:2px solid black">
                                <td class="label" style="color:black; border:1px solid black">PO #</td>
                                <td class="value" style="text-align:left; padding: 8px; width:60%; color:black"
                                    id="poNumber" value="{{ $purchaseOrder->po_number }}">{{ $purchaseOrder->po_number }}
                                </td>
                            </tr>
                            <tr style="border:2px solid black">
                                <td class="label" style="color:black; border:1px solid black">Payment Term</td>
                                <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">
                                    {{ $purchaseOrder->payment_term }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <div class="budget-verification-box mt-4">
                <h5>Description</h5>
                <p>{{ $purchaseOrder->description }}</p>
            </div>


            <div class="row mt-4">
                <div class="col-md-6">
                    <div>
                        <h6 class="text-white p-2" style="background-color:#1a73e8">Supplier Detail</h6>
                        <p><strong>Name:</strong> {{ $purchaseOrder->supplier_name }}</p>
                        <p><strong>Address:</strong> {{ $purchaseOrder->supplier_address }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <h6 class="text-white p-2" style="background-color:#1a73e8">Project Detail</h6>
                        <p><strong>Project:</strong> {{ $budget->reference_code }}</p>
                        <p><strong>Requested By:</strong>{{ $requested->first_name }}</p>
                        <p>
                            <strong>Verified By:</strong>
                            <span style="color: {{ $prepared->verified_by ? 'black' : 'red' }}">
                                {{ $prepared->verified_by ?? 'not verified' }}
                            </span>
                        </p>
                        <p><strong>Prepared By:</strong> {{ $prepared->first_name }}</p>
                    </div>
                </div>
            </div>

            <!-- Button to trigger the modal -->
            <div class="text-end mt-4">
                @php
                    $isDisabled = is_null($budget->total_budget_allocated) || $poStatus === 'submitted';
                @endphp
                @if ($purchaseOrder->status != 'submitted')
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addItemModal"
                        style="background-color:#1a73e8; color:white; {{ $isDisabled ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                        <i class="fas fa-plus"></i> Add ITEM
                    </button>
                @endif
            </div>

            <!-- Purchase Order Table -->
            <div class="table-container">
                <table class="purchase-order-table">
                    <thead>
                        <tr>
                            <th>ITEM #</th>
                            <th>DESCRIPTION OF GOODS</th>
                            <th>QTY</th>
                            <th>UNIT PRICE</th>
                            <th>TOTAL</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseOrderItems">
                        <!-- Items will be dynamically added here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Subtotal</strong></td>
                            <td id="subtotal">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Enter Discount (%)</strong></td>
                            <td><input type="number" id="discountInput" class="form-control" placeholder="0"
                                    min="0"></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Enter VAT (%)</strong></td>
                            <td><input type="number" id="vatInput" class="form-control" placeholder="5" min="0">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total Discount</strong></td>
                            <td id="totalDiscount">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total VAT</strong></td>
                            <td id="totalVAT">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total</strong></td>
                            <td id="totalAmount">0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <!-- Button to trigger POST request -->
            <div class="text-end mt-4">
                @php
                    $isDisabled = is_null($budget->total_budget_allocated) || $poStatus === 'submitted';
                @endphp
                <button type="button" class="btn" id="submitOrderBtn"
                    style="background-color:#1a73e8; color:white; {{ $isDisabled ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                    {{ $isDisabled ? 'disabled' : '' }} onClick="{{ $isDisabled ? '' : 'submitData()' }}">
                    <i class="fas fa-save"></i> {{ $purchaseOrder->status == 'submitted' ? 'Submited' : 'Submit' }}
                </button>
            </div>

            <div class="budget-verification-box mt-4">
                <h5>Budget Department Verification</h5>
                <table>
                    <tr>
                        <td class="label">Total Budget:</td>
                        <td class="value">
                            @if (is_null($budget->total_budget_allocated))
                                <span style="color: red; font-weight: bold;">Not Assigned</span>
                            @else
                                {{ number_format($budget->total_budget_allocated) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Utilization:</td>
                        <td class="value">{{ number_format($utilization) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Balance Budget:</td>
                        <td id="balance_budget" class="value" value="{{ number_format($balanceBudget) }}">
                            {{ number_format($balanceBudget) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Current Request:</td>
                        <td id="total_request_amount" class="value"></td>
                    </tr>
                    <tr>
                        <td class="label">Balance:</td>
                        <td id="total_balance_for_budget" class="value"></td>
                    </tr>
                </table>
                <div class="signature-box mt-3">
                    <table>
                        <tr>
                            <td class="signature-line">{{ $prepared->first_name }}</td>
                            <td class="signature-line">{{ $budget->month }}</td>
                        </tr>
                        <tr>
                            <td>Name & Signature</td>
                            <td>Date</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- <div style="display: flex; flex-direction: column; align-items: flex-end; width: 100%; margin-top: 2rem;">
                <hr style="width: 18rem; border: 2px solid black !important; margin: 0;">
                <strong>Approved By: Chief Executive Officer</strong>
            </div> --}}


        </div>

        <!-- Modal for adding items -->
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form id="addItemForm">
                            <div class="mb-3">
                                <label for="item" class="form-label">Item #</label>
                                <select class="form-control" id="item" name="item" required>
                                    <option value="" data-description="" data-quantity="" data-unit-cost="">Select
                                        an item</option>
                                    <!-- Dynamically populate options with item data from server -->
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            data-description="{{ $material->description }}"
                                            data-quantity="{{ $material->quantity }}"
                                            data-unit-cost="{{ $material->unit_cost }}">
                                            {{ $material->expenses }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit_price" class="form-label">Unit Price</label>
                                <input type="number" class="form-control" id="unit_price" name="unit_price" required>
                            </div>
                            <button id="addItemBtn" type="button" class="btn btn-primary">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            // Get the PO number from the hidden input field or wherever it's set
            var poNumber = document.getElementById('poNumber').textContent.trim();

            console.log(poNumber)

            // Initialize purchase order items array
            let purchaseOrderItems = [];

            function submitData() {
                let totalAmount = parseFloat(document.getElementById('totalAmount').textContent) || 0;
                let totalDiscount = parseFloat(document.getElementById('totalDiscount').textContent) || 0;
                let totalVAT = parseFloat(document.getElementById('totalVAT').textContent) || 0;

                if (totalAmount > 0) {
                    // Retrieve items from local storage
                    const storedItems = JSON.parse(localStorage.getItem(`purchaseOrder_${poNumber}`)) || [];


                    // Prepare data for submission
                    const data = {
                        poNumber: poNumber,
                        items: storedItems,
                        totalAmount: totalAmount,
                        totalDiscount: totalDiscount,
                        totalVAT: totalVAT,
                        "status": "submitted",
                        budget: '{{ $budget->id }}',
                        po_number: '{{ $purchaseOrder->po_number }}',
                    };

                    console.log(data);

                    fetch('/api/save-purchase-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Purchase order items saved successfully!') {
                                // Redirect to the specified page
                                window.location.href = '/pages/add-budget-project-purchase-order';
                            } else {
                                // Handle unexpected responses or errors
                                console.error('Unexpected response:', data);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });

                } else {
                    alert("Total amount is less than or equal to 0.");
                }
            }


            // Function to load data from local storage
            function loadFromLocalStorage(poNumber) {
                const storedItems = JSON.parse(localStorage.getItem(`purchaseOrder_${poNumber}`));
                if (storedItems) {
                    purchaseOrderItems.push(...storedItems);
                    renderTable();
                }
            }

            // Function to save data to local storage
            function saveToLocalStorage(poNumber) {
                localStorage.setItem(`purchaseOrder_${poNumber}`, JSON.stringify(purchaseOrderItems));
            }

            // Function to render the table
            function renderTable() {
                const tableBody = document.getElementById('purchaseOrderItems');
                tableBody.innerHTML = '';

                let subtotal = 0;

                purchaseOrderItems.forEach((orderItem, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${orderItem.item}</td>
                <td>${orderItem.description}</td>
                <td>${orderItem.quantity}</td>
                <td>${orderItem.unitPrice.toFixed(2)}</td>
                <td>${orderItem.itemTotal.toFixed(2)}</td>
                <td><button class="btn btn-danger" onclick="removeItem(${index})">Remove</button></td>
            `;
                    tableBody.appendChild(row);

                    subtotal += orderItem.itemTotal;
                });

                document.getElementById('subtotal').innerText = subtotal.toFixed(2);

                // Recalculate totals when discount or VAT inputs change
                updateTotals();
            }

            // Function to update totals based on discount and VAT
            function updateTotals() {
                const subtotal = parseFloat(document.getElementById('subtotal').innerText) || 0;
                const discountValue = parseFloat(document.getElementById('discountInput').value) || 0;
                const vatValue = parseFloat(document.getElementById('vatInput').value) || 0;

                // Calculate total discount and VAT
                const totalDiscount = subtotal * (discountValue / 100);
                const totalVAT = (subtotal - totalDiscount) * (vatValue / 100);

                // Update totals in the document
                document.getElementById('totalDiscount').innerText = totalDiscount.toFixed(2);
                document.getElementById('totalVAT').innerText = totalVAT.toFixed(2);
                document.getElementById('totalAmount').innerText = (subtotal - totalDiscount + totalVAT).toFixed(2);

                // Update balance
                const requestAmount = parseFloat(document.getElementById('totalAmount').innerText);
                document.getElementById('total_request_amount').innerText = requestAmount.toFixed(0).toLocaleString();;
                const balanceBudgetElement = document.getElementById('balance_budget');
                const balanceBudget = parseFloat(balanceBudgetElement.innerText.replace(/,/g, '')) || 0;
                document.getElementById('total_balance_for_budget').innerText = (balanceBudget - requestAmount).toFixed(0).toLocaleString();
            }

            // Function to remove an item
            function removeItem(index) {
                if (index >= 0 && index < purchaseOrderItems.length) {
                    // Remove item at the specified index
                    purchaseOrderItems.splice(index, 1);
                    saveToLocalStorage(poNumber); // Save updated items
                    renderTable(); // Re-render the table
                } else {
                    console.error('Invalid index for removal');
                }
            }

            document.getElementById('addItemBtn').addEventListener('click', function() {
                const item = document.getElementById('item').value;
                const description = document.getElementById('description').value;
                const quantity = parseFloat(document.getElementById('quantity').value);
                const unitPrice = parseFloat(document.getElementById('unit_price').value);

                if (!item || isNaN(quantity) || isNaN(unitPrice)) {
                    alert("Please fill out all fields correctly.");
                    return;
                }

                // Calculate item total
                const itemTotal = quantity * unitPrice;

                // Add item to the list
                purchaseOrderItems.push({
                    item,
                    description,
                    quantity,
                    unitPrice,
                    itemTotal
                });

                // Save to local storage
                saveToLocalStorage(poNumber);

                // Re-render the table with the new data
                renderTable();

                // Reset the form and close the modal
                document.getElementById('addItemForm').reset();
                $('#addItemModal').modal('hide');
            });


            // Event listeners to update totals dynamically
            document.getElementById('discountInput').addEventListener('input', updateTotals);
            document.getElementById('vatInput').addEventListener('input', updateTotals);

            // Load purchase order items from local storage when the page loads
            loadFromLocalStorage(poNumber);


            document.getElementById('item').addEventListener('change', function() {
                // Get the selected option
                var selectedOption = this.options[this.selectedIndex];

                // Get the associated data attributes
                var description = selectedOption.getAttribute('data-description');
                var quantity = selectedOption.getAttribute('data-quantity');
                var unitCost = selectedOption.getAttribute('data-unit-cost');

                console.log(description, quantity, unitCost);

                // Set the values in the corresponding fields
                document.getElementById('description').value = description;
                document.getElementById('quantity').value = quantity;
                document.getElementById('unit_price').value = unitCost;
            });
        </script>

    @endsection
