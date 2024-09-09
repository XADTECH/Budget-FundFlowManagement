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
        .header, .footer {
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
        .purchase-order-table th, .purchase-order-table td {
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
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #0067aa #f1f1f1; /* Firefox: color for scrollbar thumb and track */
}

/* For WebKit browsers (Chrome, Safari) */
.custom-modal-body::-webkit-scrollbar {
    width: 6px; /* Slim width for scrollbar */
}

.custom-modal-body::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background of the scrollbar track */
}

.custom-modal-body::-webkit-scrollbar-thumb {
    background-color: #0067aa; /* Scrollbar thumb color to match table header */
    border-radius: 10px; /* Round scrollbar thumb edges */
    border: 2px solid #f1f1f1; /* Create space between the thumb and track */
}

.custom-modal-body::-webkit-scrollbar-thumb:hover {
    background-color: #004a7a; /* Darker blue on hover */
}
    </style>
</head>
<body>

<div class="container">
      <!-- Download Button -->
      <div class="text-end mt-4">
        <a href="{{ route('download.pdf') }}" class="btn"  style="background-color:#1a73e8; color:white">
            <i class="fas fa-print"></i> Download PDF
        </a>
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
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">{{$purchaseOrder->date}}</td>
                    </tr>
                    <tr style="border:2px solid black">
                        <td class="label" style="color:black; border:1px solid black">PO #</td>
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">{{$purchaseOrder->po_number}}</td>
                    </tr>
                    <tr style="border:2px solid black">
                        <td class="label" style="color:black; border:1px solid black">Payment Term</td>
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">{{$purchaseOrder->payment_term}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="budget-verification-box mt-4">
        <h5>Description</h5>
        <p>{{$purchaseOrder->description}}</p>
    </div>


    <div class="row mt-4">
        <div class="col-md-6">
            <div>
                <h6 class="text-white p-2" style="background-color:#1a73e8">Supplier Detail</h6>
                <p><strong>Name:</strong> {{$purchaseOrder->supplier_name}}</p>
                <p><strong>Address:</strong> {{$purchaseOrder->supplier_address}}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <h6 class="text-white p-2" style="background-color:#1a73e8">Project Detail</h6>
                <p><strong>Project:</strong> {{$budget->reference_code}}</p>
                <p><strong>Requested By:</strong>{{$requested->first_name}}</p>
                <p>
                    <strong>Verified By:</strong> 
                    <span style="color: {{ $prepared->verified_by ? 'black' : 'red' }}">
                        {{ $prepared->verified_by ?? 'not verified' }}
                    </span>
                </p>
                <p><strong>Prepared By:</strong> {{$prepared->first_name}}</p>
            </div>
        </div>
    </div>

        <!-- Button to trigger the modal -->
        <div class="text-end mt-4">
            @php
                $isDisabled = is_null($budget->total_budget_allocated);
            @endphp
            <button 
                type="button" 
                class="btn" 
                data-bs-toggle="modal" 
                data-bs-target="#addItemModal" 
                style="background-color:#1a73e8; color:white; {{ $isDisabled ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                {{ $isDisabled ? 'disabled' : '' }}
            >
                <i class="fas fa-plus"></i> ADD ITEM
            </button>
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
            </tr>
        </thead>
        <tbody id="purchaseOrderItems">
            <!-- Items will be dynamically added here -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                <td id="subtotal">0.00</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Enter Discount (%)</strong></td>
                <td><input type="number" id="discountInput" class="form-control" placeholder="0"></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Enter VAT (%)</strong></td>
                <td><input type="number" id="vatInput" class="form-control" placeholder="5"></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Total Discount</strong></td>
                <td id="totalDiscount">0.00</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Total VAT</strong></td>
                <td id="totalVAT">0.00</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Total</strong></td>
                <td id="totalAmount">0.00</td>
            </tr>
        </tfoot>
    </table>
</div>


    <div class="budget-verification-box mt-4">
        <h5>Budget Department Verification</h5>
        <table>
            <tr>
                <td class="label">Total Budget:</td>
                <td class="value">
                @if(is_null($budget->total_budget_allocated))
                    <span style="color: red; font-weight: bold;">Not Assigned</span>
                @else
                    {{ $budget->total_budget_allocated }}
                @endif
            </td>
            </tr>
            <tr>
                <td class="label">Utilization:</td>
                <td class="value">{{number_format($utilization)}}</td>
            </tr>
            <tr>
                <td class="label">Balance Budget:</td>
                <td id="balance_budget" class="value" value="{{number_format($balanceBudget)}}">{{number_format($balanceBudget)}}</td>
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
                    <td class="signature-line">{{$prepared->first_name}}</td>
                    <td class="signature-line">{{$budget->month}}</td>
                </tr>
                <tr>
                    <td>Name & Signature</td>
                    <td>Date</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; align-items: flex-end; width: 100%; margin-top: 2rem;">
    <hr style="width: 18rem; border: 2px solid black !important; margin: 0;">
    <strong>Approved By: Chief Executive Officer</strong>
</div>

  
</div>

<!-- Modal for adding items -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" id="item" name="item" required>
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
                    <button type="button" class="btn btn-primary" id="addItemBtn">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const purchaseOrderItems = [];

    // Event listeners to update totals dynamically
    document.getElementById('discountInput').addEventListener('input', updateTotals);
    document.getElementById('vatInput').addEventListener('input', updateTotals);
    
    document.getElementById('addItemBtn').addEventListener('click', function() {
        const item = document.getElementById('item').value;
        const description = document.getElementById('description').value;
        const quantity = parseFloat(document.getElementById('quantity').value);
        const unitPrice = parseFloat(document.getElementById('unit_price').value);

        // Calculate item total
        const itemTotal = quantity * unitPrice;
        

        // Add item to the list
        purchaseOrderItems.push({ item, description, quantity, unitPrice, itemTotal });

        // Render the table
        renderTable();

        // Reset the modal form and close the modal
        document.getElementById('addItemForm').reset();
        $('#addItemModal').modal('hide');
    });

    function renderTable() {
        const tableBody = document.getElementById('purchaseOrderItems');
        tableBody.innerHTML = '';

        let subtotal = 0;

        purchaseOrderItems.forEach(orderItem => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${orderItem.item}</td>
                <td>${orderItem.description}</td>
                <td>${orderItem.quantity}</td>
                <td>${orderItem.unitPrice.toFixed(2)}</td>
                <td>${orderItem.itemTotal.toFixed(2)}</td>
            `;
            tableBody.appendChild(row);

            subtotal += orderItem.itemTotal;
        });

        document.getElementById('subtotal').innerText = subtotal.toFixed(2);

        // Recalculate totals when discount or VAT inputs change
        updateTotals();
      
    }
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
    const requestAmount = parseFloat(subtotal - totalDiscount + totalVAT).toFixed(2); // Ensure requestAmount is a number
    document.getElementById('total_request_amount').innerText = requestAmount;
    const balanceBudgetElement = document.getElementById('balance_budget');
const balanceBudget = parseFloat(balanceBudgetElement.innerText.replace(/,/g, '')) || 0; // Remove commas and convert to number
    console.log(balanceBudget);
    document.getElementById('total_balance_for_budget').innerText = (balanceBudget - requestAmount).toFixed(2);
}
</script>
@endsection