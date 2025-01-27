@extends('layouts/contentNavbarLayout')

@section('title', 'Purchase Order - summary')

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
                        <p><strong>Project Code:</strong> {{ $budget->reference_code }}</p>
                        <p><strong>Requested By:</strong>{{ $requested->first_name }}</p>
                        {{-- <p>
                            <strong>Verified By:</strong>
                            <span style="color: {{ $prepared->verified_by ? 'black' : 'red' }}">
                                {{ $prepared->verified_by ?? 'not verified' }}
                            </span>
                        </p> --}}
                        <p><strong>Prepared By:</strong> {{ $prepared->first_name }}</p>
                        <p><strong>Project Name :</strong> {{ $budget->budget_type }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="purchaseOrderType" class="form-label">Purchase Order Type:</label>
                <select id="purchaseOrderType" name="purchaseOrderType" class="form-select">
                    <option value="standard">Standard / (Material) PO</option>
                    <option value="pettyCash">Service PO</option>
                </select>
            </div>

            <!-- Purchase Order Table -->
            <div class="table-container" id="poTableContainer">
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
                            <td colspan="5" class="text-end"><strong>Enter Delivery Charges</strong></td>
                            <td><input type="number" id="deliveryChargesInput" class="form-control" placeholder="0"
                                    min="0"></td>
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

                <div class="text-end mt-4">
                    <!-- Button to trigger POST request -->
                <button type="button" class="btn" id="submitOrderBtn"
                style="background-color:#1a73e8; color:white; {{ $isDisabled ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                {{ $isDisabled ? 'disabled' : '' }}>
                <i class="fas fa-save"></i> {{ $purchaseOrder->status == 'submitted' ? 'Submitted' : 'Submit' }}
            </button>
                </div>
            </div>
        </div>

        <!-- Petty Cash Purchase Order -->
        <div class="service-po mt-5" id="pettyCashSection" style="display: none;">
            <h4>Service Purchase Order</h4>

            <!-- Button to trigger the modal -->
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal">
                    <i class="fas fa-plus"></i> Add Service Item
                </button>
            </div>

            <!-- Table to display the service items -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="serviceItemsTable">
                        <!-- Dynamically added rows will appear here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total Amount</strong></td>
                            <td colspan="2" id="totalAmountDisplay">0.00 AED</td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Submit button for Service Items -->
                <div class="text-end mt-3">
                    <button id="submitServiceItems" class="btn btn-primary">Submit Service Items</button>
                </div>

            </div>


        </div>

        @if ($purchaseOrder->status !== 'submitted')
            <div class="budget-verification-box mt-4">
                <h5>Budget Department Verification</h5>
                <table>
                    <tr>
                        <td class="label">Total Budget:</td>
                        <td class="value">
                            <span id="budgetDisplay">
                                @if (is_null($totalBudget))
                                    <span style="color: red; font-weight: bold;">Not Assigned</span>
                                @else
                                    {{ number_format($totalBudget) }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Utilization:</td>
                        <td class="value" id="utilize">{{ number_format($utilization) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Balance Budget:</td>
                        <td id="balance_budget" class="value">
                            {{ number_format($balanceBudget) }}
                        </td>
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
                            <td class="signature-line">{{ $prepared->first_name . ' ' . $prepared->last_name }}</td>
                            <td class="signature-line">{{ $budget->month }}</td>
                        </tr>
                        <tr>
                            <td>Name & Signature</td>
                            <td>Date</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endif



        <!-- Modal for adding/updating service items -->
        <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModalLabel">Add Service Items</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="serviceItemForm">
                            <div class="mb-3">
                                <label for="itemDescription" class="form-label">Description</label>
                                <textarea id="itemDescription" class="form-control" rows="3" placeholder="Enter service description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="itemPrice" class="form-label">Price</label>
                                <input type="number" id="itemPrice" class="form-control" placeholder="0.00"
                                    step="0.01" required />
                            </div>
                            <div class="mb-3">
                                <label for="itemTotal" class="form-label">Total</label>
                                <input type="number" id="itemTotal" class="form-control" placeholder="0.00"
                                    step="0.01" readonly />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveServiceItem">Save</button>
                    </div>
                </div>
            </div>
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
                        <!-- Display Category Budget -->
                        <div class="mb-3">
                            <strong>Budget: </strong><span id="categoryBudget">0</span>
                        </div>

                        <!-- Display Total Requested Amount -->
                        <div class="mb-3">
                            <strong>Total Requested Amount: </strong><span id="totalRequestedAmount">0</span>
                        </div>

                        <form id="addItemForm">
                            <!-- Category Selection -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select a category</option>
                                    <option value="material">Material</option>
                                    <option value="capital_expenses">Capital Expenditure</option>
                                    {{-- <option value="salary">Salary</option>
                                        <option value="facilities">Facilities</option>
                                        <option value="financial">Financial</option>
                                        <option value="overhead">Overhead </option> --}}
                                </select>
                            </div>

                            <!-- Item No -->
                            <div class="mb-3">
                                <label for="itemNo" class="form-label">Item No</label>
                                <input type="text" class="form-control" id="itemNo" name="itemNo"
                                    placeholder="Enter Item No (e.g., XAD00052)" required>
                            </div>

                            <!-- Item Selection -->
                            <div class="mb-3" id="itemContainer" style="display:none;">
                                <label for="item" class="form-label">Item</label>
                                <select class="form-control" id="item" name="item" required>
                                    <option value="" data-description="" data-quantity="" data-unit-cost="">
                                        Select
                                        an item</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            data-description="{{ $material->description }}"
                                            data-quantity="{{ $material->quantity }}"
                                            data-unit-cost="{{ $material->unit_cost }}">
                                            {{ $material->expenses }} - {{ $material->description }}
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
                            <button id="addItemBtn" type="button" class="btn btn-primary" disabled>Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            /*****************
             * Load server data first (if available),
             * then fall back to local storage if needed.
             *****************/
            async function loadPurchaseOrderData(poNumber) {
                let fetchedData = null;

                try {
                    const response = await fetch(`/get-purchase-order/${poNumber}`);
                    if (!response.ok) {
                        throw new Error('Failed to fetch purchase order details');
                    }
                    fetchedData = await response.json();
                } catch (error) {
                    console.warn('Could not fetch from server:', error.message);
                }

                // Separate items by category
                let materialItemsFromServer = [];
                let serviceItemsFromServer = [];

                if (fetchedData && Array.isArray(fetchedData.items)) {
                    materialItemsFromServer = fetchedData.items.filter(
                        (item) => (item.category || '').toLowerCase() === 'material'
                    );
                    serviceItemsFromServer = fetchedData.items.filter(
                        (item) => (item.category || '').toLowerCase() === 'service'
                    );
                }

                // Get what's in local storage
                let localMaterialItems = JSON.parse(localStorage.getItem(`purchaseOrder_${poNumber}`)) || [];
                let localServiceItems = JSON.parse(localStorage.getItem(`serviceOrder_${poNumber}`)) || [];

                // Overwrite local storage if server has new data
                if (materialItemsFromServer.length > 0) {
                    localStorage.setItem(`purchaseOrder_${poNumber}`, JSON.stringify(materialItemsFromServer));
                    localMaterialItems = materialItemsFromServer;
                }
                if (serviceItemsFromServer.length > 0) {
                    localStorage.setItem(`serviceOrder_${poNumber}`, JSON.stringify(serviceItemsFromServer));
                    localServiceItems = serviceItemsFromServer;
                }

                return {
                    materialItems: localMaterialItems,
                    serviceItems: localServiceItems,
                    serverData: fetchedData
                };
            }

            /*****************
             * Main Script
             *****************/
            document.addEventListener('DOMContentLoaded', async () => {
                // ----- Get essential DOM elements -----
                const quantityInput = document.getElementById('quantity');
                const unitPriceInput = document.getElementById('unit_price');
                const addItemBtn = document.getElementById('addItemBtn');
                const totalRequestedAmountDisplay = document.getElementById('totalRequestedAmount');
                const purchaseOrderTypeSelect = document.getElementById('purchaseOrderType');
                const poTableContainer = document.getElementById('poTableContainer');
                const pettyCashSection = document.getElementById('pettyCashSection');
                const serviceItemsTable = document.getElementById('serviceItemsTable');
                const totalAmountDisplay = document.getElementById('totalAmountDisplay');
                const itemDescription = document.getElementById('itemDescription');
                const descriptionField = document.getElementById('description');
                const itemPrice = document.getElementById('itemPrice');
                const itemTotal = document.getElementById('itemTotal');
                const poNumber = document.getElementById('poNumber').textContent.trim();
                const purchaseOrderStatus = @json($purchaseOrder->status);

                // For removing items in the table
                let currentRow = null;
                const itemNoInput = document.getElementById('itemNo');
                const purchaseOrderItemsTable = document.getElementById('purchaseOrderItems');

                document.getElementById('submitOrderBtn').addEventListener('click', () => {
        if (!{{ $isDisabled ? 'true' : 'false' }}) {
            submitData();
        }
    });

                // ----- Load from server first, fallback to local storage -----
                let materialItems = [];
                let serviceItems = [];

                // If the PO is submitted, we still fetch from the server to ensure correct display
                // If not submitted, we also fetch so we can sync with server if items exist
                const {
                    materialItems: matFromServer,
                    serviceItems: servFromServer
                } = await loadPurchaseOrderData(poNumber);

                // Put them into local arrays
                materialItems = matFromServer;
                serviceItems = servFromServer;

                // ----- Our global references to store items in memory -----
                let purchaseOrderItems = materialItems; // "Material" PO items
                let serviceOrderItems = serviceItems; // "Service" PO items

                // ----- Prepare event listeners -----
                // Add item button (material)
                addItemBtn.addEventListener('click', () => saveMaterialItem());

                // Submit button for service items
                document.getElementById('submitServiceItems').addEventListener('click', submitServiceItems);

                // Save Service Item (click on "Save" in modal)
                document.getElementById('saveServiceItem').addEventListener('click', saveServiceItem);

                // Recalculate total in Service Modal
                document.getElementById('itemPrice').addEventListener('input', () => {
                    const price = parseFloat(document.getElementById('itemPrice').value || 0);
                    document.getElementById('itemTotal').value = price.toFixed(2);
                });

                // Purchase order type changed
                purchaseOrderTypeSelect.addEventListener('change', () => {
                    if (canTogglePOType()) {
                        togglePOType();
                    }
                });

                // Discount, VAT, delivery changes
                ['discountInput', 'vatInput', 'deliveryChargesInput'].forEach(id => {
                    document.getElementById(id).addEventListener('input', () => {
                        updateTotals();
                    });
                });

                // Category, item, quantity, unit price events
                document.getElementById('category').addEventListener('change', handleCategoryChange);
                document.getElementById('item').addEventListener('change', populateItemDetails);
                quantityInput.addEventListener('input', calculateTotalCost);
                unitPriceInput.addEventListener('input', calculateTotalCost);
                itemPrice.addEventListener('input', () => {
                    const price = parseFloat(itemPrice.value || 0);
                    itemTotal.value = price.toFixed(2);
                });

                // ----- Initialize Page -----
                renderTable(); // Renders material items in the table
                renderServiceTable(); // Renders service items
                initializePOType(); // Decide which PO type to show

                /********************************************************
                 * SERVICE ITEMS
                 ********************************************************/
                function saveServiceItem() {
                    const desc = document.getElementById('itemDescription').value.trim();
                    const price = parseFloat(document.getElementById('itemPrice').value || 0).toFixed(2);
                    const total = parseFloat(document.getElementById('itemTotal').value || 0).toFixed(2);

                    if (!desc || isNaN(price) || price <= 0) {
                        alert('Please fill in all fields correctly.');
                        return;
                    }

                    // Add to array
                    serviceOrderItems.push({
                        description: desc,
                        price: parseFloat(price),
                        total: parseFloat(total),
                    });

                    saveServiceItemsToLocalStorage();
                    renderServiceTable();

                    // Reset the form & close modal
                    document.getElementById('serviceItemForm').reset();
                    bootstrap.Modal.getInstance(document.getElementById('serviceModal')).hide();
                }

                function renderServiceTable() {
                    const tableBody = document.getElementById('serviceItemsTable');
                    tableBody.innerHTML = '';
                    let totalAmount = 0;

                    serviceOrderItems.forEach((item, index) => {
                        totalAmount += item.total;
                        const removeButton =
                            `<button class="btn btn-danger btn-sm" onclick="removeServiceItem(${index})">Remove</button>`;
                        tableBody.insertAdjacentHTML(
                            'beforeend',
                            `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.description}</td>
                                        <td>${item.price.toFixed(2)} AED</td>
                                        <td>${item.total.toFixed(2)} AED</td>
                                        <td>${removeButton}</td>
                                    </tr>
                                `
                        );
                    });

                    document.getElementById('totalAmountDisplay').textContent = totalAmount.toFixed(0);

                    const balanceBudget = parseFloat(document.getElementById('balance_budget').textContent.replace(
                        /,/g, '')) || 0;
                    document.getElementById('total_request_amount').textContent = totalAmount;
                    document.getElementById('total_balance_for_budget').textContent = (balanceBudget - totalAmount)
                        .toLocaleString();
                }

                function removeServiceItem(index) {
                    serviceOrderItems.splice(index, 1);
                    saveServiceItemsToLocalStorage();
                    renderServiceTable();
                }

                function saveServiceItemsToLocalStorage() {
                    localStorage.setItem(`serviceOrder_${poNumber}`, JSON.stringify(serviceOrderItems));
                }

                function submitServiceItems() {
                    // Implement the actual submission logic for service items here if needed.
                    alert('Service items submitted (handle as needed).');
                }

                /********************************************************
                 * MATERIAL (STANDARD) ITEMS
                 ********************************************************/
                function saveMaterialItem() {
                    const itemNo = document.getElementById('itemNo').value.trim();
                    const desc = descriptionField.value.trim();
                    const quantityVal = parseFloat(document.getElementById('quantity').value || 0);
                    const unitPriceVal = parseFloat(document.getElementById('unit_price').value || 0);
                    const categoryVal = document.getElementById('category').value;
                    const b_id = {{ $purchaseOrder ? json_encode($purchaseOrder->project_id) : 'null' }};
                    const total = (quantityVal * unitPriceVal).toFixed(2);

                    if (!itemNo || !desc || isNaN(quantityVal) || isNaN(unitPriceVal)) {
                        alert('Please fill in all fields correctly.');
                        return;
                    }

                    calculateTotalCost();

                    purchaseOrderItems.push({
                        itemNo,
                        description: desc,
                        quantity: quantityVal,
                        unitPrice: unitPriceVal,
                        itemTotal: quantityVal * unitPriceVal,
                        category: categoryVal,
                        poNumber,
                        b_id
                    });

                    saveMaterialItemsToLocalStorage();
                    renderTable();

                    // Reset form & close modal
                    document.getElementById('addItemForm').reset();
                    document.getElementById('categoryBudget').innerHTML = '0';
                    document.getElementById('totalRequestedAmount').innerHTML = '0';
                    bootstrap.Modal.getInstance(document.getElementById('addItemModal')).hide();
                }

                function removeItem(index) {
                    purchaseOrderItems.splice(index, 1);
                    saveMaterialItemsToLocalStorage();
                    renderTable();
                }

                function saveMaterialItemsToLocalStorage() {
                    localStorage.setItem(`purchaseOrder_${poNumber}`, JSON.stringify(purchaseOrderItems));
                }

                /********************************************************
                 * TOGGLE PURCHASE ORDER TYPE (Material vs. Service)
                 ********************************************************/
                function initializePOType() {
                    const hasMaterialItems = purchaseOrderItems.length > 0;
                    const hasServiceItems = serviceOrderItems.length > 0;

                    if (hasMaterialItems) {
                        purchaseOrderTypeSelect.value = 'standard';
                    } else if (hasServiceItems) {
                        purchaseOrderTypeSelect.value = 'pettyCash';
                    } else {
                        purchaseOrderTypeSelect.value = 'standard';
                    }
                    togglePOType();
                }

                function canTogglePOType() {
                    const selectedType = purchaseOrderTypeSelect.value;
                    const hasMaterialItems = purchaseOrderItems.length > 0;
                    const hasServiceItems = serviceOrderItems.length > 0;

                    if (selectedType === 'standard' && hasServiceItems) {
                        alert('You have already added service items. Switching to Material PO is not allowed.');
                        purchaseOrderTypeSelect.value = 'pettyCash';
                        return false;
                    }

                    if (selectedType === 'pettyCash' && hasMaterialItems) {
                        alert('You have already added material items. Switching to Service PO is not allowed.');
                        purchaseOrderTypeSelect.value = 'standard';
                        return false;
                    }

                    return true;
                }

                function togglePOType() {
                    const selectedType = purchaseOrderTypeSelect.value;
                    if (selectedType === 'standard') {
                        poTableContainer.style.display = 'block';
                        pettyCashSection.style.display = 'none';
                    } else {
                        poTableContainer.style.display = 'none';
                        pettyCashSection.style.display = 'block';
                    }
                }

                /********************************************************
                 * RENDER MATERIAL TABLE
                 ********************************************************/
                async function renderTable() {
                    const tableBody = document.getElementById('purchaseOrderItems');
                    tableBody.innerHTML = '';
                    let subtotal = 0;
                    let itemsToRender = [];

                    if (purchaseOrderStatus === 'submitted') {
                        // Already fetched from the server in loadPurchaseOrderData,
                        // but let's call the server again to get the final amounts if needed
                        try {
                            const response = await fetch(`/get-purchase-order/${poNumber}`);
                            if (!response.ok) {
                                throw new Error('Failed to fetch purchase order details');
                            }
                            const data = await response.json();
                            itemsToRender = data.items || [];

                            // Update discount, VAT, and others from server
                            document.getElementById('discountInput').value = data.discount_value || 0;
                            document.getElementById('vatInput').value = data.vat_value || 0;
                            document.getElementById('deliveryChargesInput').value = data.delivery_charges || 0;

                            document.getElementById('discountInput').readOnly = true;
                            document.getElementById('vatInput').readOnly = true;
                            document.getElementById('deliveryChargesInput').readOnly = true;

                            document.getElementById('totalDiscount').textContent = parseFloat(data
                                .total_discount).toFixed(2);
                            document.getElementById('totalVAT').textContent = parseFloat(data.total_vat)
                                .toFixed(2);
                            document.getElementById('totalAmount').textContent = parseFloat(data.total_amount)
                                .toFixed(2);
                        } catch (error) {
                            console.error('Error fetching purchase order:', error);
                            return;
                        }
                    } else {
                        // Not submitted: use local storage array
                        itemsToRender = purchaseOrderItems;
                    }

                    itemsToRender.forEach((orderItem, index) => {
                        subtotal += parseFloat(orderItem.itemTotal);
                        const removeButton = (purchaseOrderStatus === 'submitted') ?
                            `<button class="btn btn-danger" disabled>Remove</button>` :
                            `<button class="btn btn-danger" onclick="removeItem(${index})">Remove</button>`;

                        tableBody.insertAdjacentHTML(
                            'beforeend',
                            `
                                    <tr>
                                        <td>${orderItem.itemNo}</td>
                                        <td>${orderItem.description}</td>
                                        <td>${orderItem.quantity}</td>
                                        <td>${parseFloat(orderItem.unitPrice).toFixed(2)} AED</td>
                                        <td>${parseFloat(orderItem.itemTotal).toFixed(2)} AED</td>
                                        <td>${removeButton}</td>
                                    </tr>
                                `
                        );
                    });

                    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
                    updateTotals();
                }

                /********************************************************
                 * UPDATE TOTALS
                 ********************************************************/
                async function updateTotals() {
                    if (purchaseOrderStatus === 'submitted') {
                        try {
                            const response = await fetch(`/get-purchase-order/${poNumber}`);
                            if (!response.ok) throw new Error('Failed to fetch purchase order details');
                            const data = await response.json();

                            document.getElementById('discountInput').value = data.discount_value || 0;
                            document.getElementById('vatInput').value = data.vat_value || 0;
                            document.getElementById('deliveryChargesInput').value = data.delivery_charges || 0;

                            document.getElementById('discountInput').readOnly = true;
                            document.getElementById('vatInput').readOnly = true;
                            document.getElementById('deliveryChargesInput').readOnly = true;

                            document.getElementById('totalDiscount').textContent = parseFloat(data
                                .total_discount).toFixed(2);
                            document.getElementById('totalVAT').textContent = parseFloat(data.total_vat)
                                .toFixed(2);
                            document.getElementById('totalAmount').textContent = parseFloat(data.total_amount)
                                .toFixed(2);

                            const requestAmount = parseFloat(data.total_amount || 0);
                            const balanceBudget = parseFloat(document.getElementById('balance_budget')
                                .textContent.replace(/,/g, '')) || 0;

                            document.getElementById('total_request_amount').textContent = requestAmount
                                .toLocaleString();
                            document.getElementById('total_balance_for_budget').textContent = (balanceBudget -
                                requestAmount).toLocaleString();

                            // Also re-render items table for final server data
                            const itemsTableBody = document.querySelector('#itemsTable tbody');
                            if (itemsTableBody) {
                                itemsTableBody.innerHTML = '';
                                data.items.forEach(item => {
                                    const row = `
                                            <tr>
                                                <td>${item.itemNo}</td>
                                                <td>${item.description}</td>
                                                <td>${item.quantity}</td>
                                                <td>${parseFloat(item.unitPrice).toFixed(2)}</td>
                                                <td>${parseFloat(item.itemTotal).toFixed(2)}</td>
                                            </tr>
                                        `;
                                    itemsTableBody.innerHTML += row;
                                });
                            }
                        } catch (error) {
                            console.error('Error fetching purchase order:', error);
                        }
                    } else {
                        // Not submitted => allow editing
                        document.getElementById('discountInput').readOnly = false;
                        document.getElementById('vatInput').readOnly = false;
                        document.getElementById('deliveryChargesInput').readOnly = false;

                        const subtotal = parseFloat(document.getElementById('subtotal').textContent) || 0;
                        const discountValue = parseFloat(document.getElementById('discountInput').value) || 0;
                        const vatValue = parseFloat(document.getElementById('vatInput').value) || 0;
                        const deliveryCharges = parseFloat(document.getElementById('deliveryChargesInput')
                            .value) || 0;

                        const totalDiscount = subtotal * (discountValue / 100);
                        const totalVAT = (subtotal - totalDiscount) * (vatValue / 100);
                        const totalAmount = subtotal - totalDiscount + totalVAT + deliveryCharges;

                        document.getElementById('totalDiscount').textContent = totalDiscount.toFixed(2);
                        document.getElementById('totalVAT').textContent = totalVAT.toFixed(2);
                        document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);

                        const requestAmount = totalAmount;
                        const balanceBudget = parseFloat(document.getElementById('balance_budget').textContent
                            .replace(/,/g, '')) || 0;

                        document.getElementById('total_request_amount').textContent = requestAmount
                            .toLocaleString();
                        document.getElementById('total_balance_for_budget').textContent = (balanceBudget -
                            requestAmount).toLocaleString();
                    }
                }

                /********************************************************
                 * CATEGORY & ITEM SELECTION
                 ********************************************************/
                function handleCategoryChange() {
                    const selectedCategory = document.getElementById('category').value;
                    const itemContainer = document.getElementById('itemContainer');
                    const itemDropdown = document.getElementById('item');
                    const categoryBudget = document.getElementById('categoryBudget');
                    const totalRequestedAmountDisplay = document.getElementById('totalRequestedAmount');
                    const descriptionInput = document.getElementById('description');
                    const quantityInput = document.getElementById('quantity');
                    const unitPriceInput = document.getElementById('unit_price');

                    // Reset fields
                    totalRequestedAmountDisplay.textContent = '0';
                    descriptionInput.value = '';
                    quantityInput.value = '';
                    unitPriceInput.value = '';

                    // Show/hide item container
                    itemContainer.style.display = 'block';
                    itemDropdown.innerHTML = '<option value="">Select an item</option>';

                    let items = [];
                    let budget = 0;

                    switch (selectedCategory) {
                        case 'material':
                            items = @json($materials);
                            budget = {{ $materialBudget ?? 0 }};
                            break;
                        case 'salary':
                            items = @json($salaries);
                            budget = {{ $salaryBudget ?? 0 }};
                            break;
                        case 'facilities':
                            items = @json($facilities);
                            budget = {{ $facilityBudget ?? 0 }};
                            break;
                        case 'capital_expenses':
                            items = @json($capitalExpenses);
                            budget = {{ $capitalExpensesTotal ?? 0 }};
                            break;
                        case 'financial':
                            items = @json($financial);
                            budget = {{ $financialBudget ?? 0 }};
                            break;
                        case 'overhead':
                            items = @json($overhead);
                            budget = {{ $overheadBudget ?? 0 }};
                            break;
                    }

                    categoryBudget.textContent = new Intl.NumberFormat().format(budget);

                    items.forEach(item => {
                        const q = item.quantity ?? item.total_number ?? 0;
                        const u = item.unit_cost ?? item.cost ?? 0;

                        itemDropdown.insertAdjacentHTML('beforeend', `
                                <option value="${item.id}"
                                        data-description="${item.description || ''}"
                                        data-quantity="${q}"
                                        data-unit-cost="${u}">
                                    ${item.expenses} - ${item.description}
                                </option>
                            `);
                    });
                }

                function populateItemDetails() {
                    const itemDropdown = document.getElementById('item');
                    const selectedOption = itemDropdown.options[itemDropdown.selectedIndex];

                    descriptionField.value = selectedOption.getAttribute('data-description');
                    document.getElementById('quantity').value = selectedOption.getAttribute('data-quantity');
                    document.getElementById('unit_price').value = selectedOption.getAttribute('data-unit-cost');
                    calculateTotalCost();
                }

                function calculateTotalCost() {
                    const quantityVal = parseFloat(quantityInput.value) || 0;
                    const unitPriceVal = parseFloat(unitPriceInput.value) || 0;
                    const totalCost = quantityVal * unitPriceVal;

                    const categoryBudgetValue = parseFloat(document.getElementById('categoryBudget').textContent
                        .replace(/,/g, '')) || 0;
                    totalRequestedAmountDisplay.textContent = totalCost.toLocaleString('en-US', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    });

                    if (totalCost > categoryBudgetValue) {
                        addItemBtn.disabled = true;
                        alert('There is not enough budget.');
                    } else {
                        addItemBtn.disabled = false;
                    }
                }

                /********************************************************
                 * FINAL SUBMISSION (POST to /api/save-purchase-order)
                 ********************************************************/
                function submitData() {
                    const totalAmount = parseFloat(document.getElementById('totalAmount').textContent) || 0;
                    const deliveryCharges = parseFloat(document.getElementById('deliveryChargesInput').value) || 0;
                    const discountValue = parseFloat(document.getElementById('discountInput').value) || 0;
                    const vatValue = parseFloat(document.getElementById('vatInput').value) || 0;
                    const initialBudget = parseFloat(document.getElementById('budgetDisplay').textContent.replace(
                        /,/g, '')) || 0;
                    const utilization = parseFloat(document.getElementById('utilize').textContent.replace(/,/g,
                        '')) || 0;
                    const budgetBalance = parseFloat(document.getElementById('balance_budget').textContent.replace(
                        /,/g, '')) || 0;
                    const requestAmount = parseFloat(document.getElementById('total_request_amount').textContent
                        .replace(/,/g, '')) || 0;
                    const remainBudget = parseFloat(document.getElementById('total_balance_for_budget').textContent
                        .replace(/,/g, '')) || 0;

                    if (totalAmount <= 0) {
                        alert('Total amount must be greater than 0.');
                        return;
                    }

                    const data = {
                        items: purchaseOrderItems, // material items
                        totalDiscount: parseFloat(document.getElementById('totalDiscount').textContent.replace(
                            /,/g, '')) || 0,
                        totalVAT: parseFloat(document.getElementById('totalVAT').textContent.replace(/,/g,
                            '')) || 0,
                        status: 'submitted',
                        budget: '{{ $budget->id }}',
                        poNumber: '{{ $purchaseOrder->po_number }}',
                        vatValue,
                        discountValue,
                        initialBudget,
                        utilization,
                        budgetBalance,
                        requestAmount,
                        remainBudget,
                        totalAmount,
                        deliveryCharges
                    };

                    // Save local storage
                    if (purchaseOrderItems.length > 0) {
                        localStorage.setItem(`purchaseOrder_${poNumber}`, JSON.stringify(purchaseOrderItems));
                    }

                    fetch('/api/save-purchase-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(res => {
                            if (res.message === 'Purchase order items saved successfully!') {
                                sessionStorage.setItem('success', res.message);
                                window.location.href = '/pages/add-budget-project-purchase-order';
                            } else {
                                console.error('Unexpected response:', res);
                            }
                        })
                        .catch(console.error);
                }
            });
        </script>



    @endsection
