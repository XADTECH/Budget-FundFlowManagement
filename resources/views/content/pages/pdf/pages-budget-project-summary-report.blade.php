<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Local Purchase Order - {{ $purchaseOrder->po_number }}</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px; /* Reduced font size for better fit */
            color: #000;
            padding: 20px;
        }

        .header {
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
        }

        .header .logo {
            width: 150px; /* Adjusted for better fit */
            height: auto;
        }

        .header .company-details {
            text-align: right;
            font-size: 12px;
            flex: 1; /* Takes up remaining space */
            min-width: 200px; /* Ensures readability on smaller screens */
        }

        .header-bottom {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-family: Arial, sans-serif;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .no-border {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Flex container for side-by-side tables */
        .side-by-side {
            display: flex;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
            gap: 20px; /* Space between tables */
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .side-by-side table {
            flex: 1; /* Equal width */
            min-width: 250px; /* Ensures readability on smaller screens */
            border: 1px solid #000;
        }

        /* Sign-off section */
        .sign-off {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
        }

        .sign-off table {
            width: 40%;
            border: 1px solid #000;
        }

        .terms {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Purchase Order Details Table Adjustments */
        .header-bottom table {
            table-layout: fixed; /* Ensures fixed table layout */
        }

        .header-bottom td:first-child {
            width: 30%; /* Adjust label column width */
            font-weight: bold;
        }

        .header-bottom td:last-child {
            width: 70%; /* Adjust value column width */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .side-by-side {
                flex-direction: column;
            }

            .sign-off table {
                width: 100%;
                margin-top: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header .company-details {
                text-align: left;
                margin-top: 10px;
                width: 100%;
            }

            .header-bottom table td:first-child,
            .header-bottom table td:last-child {
                width: 100%;
            }

            .header-bottom table td:last-child {
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
            <!-- Company Details -->
        <div class="company-details">
        <img src="{{ public_path('assets/img/xad/xad.jfif') }}" alt="Xad Technologies LLC Logo" class="logo" style="height: 50px;width:50px"> 

            <p><strong>Xad Technologies LLC</strong></p>
            <p>Office 1308, Opal Tower Business Bay, Dubai</p>
            <p>TRN: 100293391400003</p>
            <p>Email: admin@xadtech.com | Mobile: 054-7104301</p>
            <p>Website: www.xadtechnologies.com</p>
        </div>
    </div>

    <!-- Purchase Order Details -->
    <div class="header-bottom">
        <table>
            <tr>
                <td class="no-border font-bold">Purchase Order</td>
                <td class="no-border">{{ $purchaseOrder->po_number }}</td>
            </tr>
            <tr>
                <td class="no-border font-bold">Date</td>
                <td class="no-border">{{ \Carbon\Carbon::parse($purchaseOrder->date)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td class="no-border font-bold">Payment Terms</td>
                <td class="no-border">{{ ucfirst($purchaseOrder->payment_term) }}</td>
            </tr>
            <tr>
                <td class="no-border font-bold">PO Status</td>
                <td class="no-border">{{ ucfirst($poStatus) }}</td>
            </tr>
        </table>
    </div>

    <!-- Supplier and Project Details -->
    <table>
        <tr class="text-center font-bold">
            <th>Supplier Detail</th>
            <th>Project Detail</th>
        </tr>
        <tr>
            <td><strong>Name:</strong> {{ $purchaseOrder->supplier_name }}</td>
            <td><strong>Project:</strong> {{ $budget->reference_code }}</td>
        </tr>
        <tr>
            <td><strong>Address:</strong> {{ $purchaseOrder->supplier_address }}</td>
            <td><strong>Requested By:</strong> {{ $requested->first_name }} {{ $requested->last_name }}</td>
        </tr>
        <tr>
            <td class="no-border"></td>
            <td><strong>Project Name:</strong> {{ $budget->budget_type }}</td>
        </tr>
        <tr>
            <td class="no-border"></td>
            <td><strong>Prepared By:</strong> {{ $prepared->first_name }} {{ $prepared->last_name }}</td>
        </tr>
    </table>

    <!-- Items Table -->
    <table>
        <tr class="font-bold text-center">
            <th>ITEM #</th>
            <th>DESCRIPTION OF GOODS</th>
            <th>QTY</th>
            <th>UNIT PRICE</th>
            <th>TOTAL</th>
        </tr>
        @foreach ($purchaseOrderItems as $item)
            <tr>
                <td>{{ $item['itemNo'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ number_format($item['unitPrice'], 2) }}</td>
                <td>{{ number_format($item['itemTotal'], 2) }}</td>
            </tr>
        @endforeach
    </table>

    <!-- Terms and Conditions -->
    <p class="terms"><strong>Terms And Conditions:</strong> As agreed with supplier (Mention in the provided Quotation)</p>

    <!-- Side by Side Tables: VAT, Discount, Delivery Charges and Budget Verification -->
    <div class="side-by-side">
        <!-- Left Table: VAT, Discount, Delivery Charges -->
        <table>
            <tr>
                <td class="font-bold">VAT:</td>
                <td class="text-right">{{ $purchaseOrderItem->total_vat }}</td>
            </tr>
            <tr>
                <td class="font-bold">Total Discount:</td>
                <td class="text-right">{{ $purchaseOrderItem->total_discount }}</td>
            </tr>
            <tr>
                <td class="font-bold">Delivery Charges:</td>
                <td class="text-right">{{ $purchaseOrderItem->delivery_charges }}</td>
            </tr>
        </table>

        <!-- Right Table: Budget Department Verification -->
        <table>
            <tr>
                <td class="font-bold">Total Budget:</td>
                <td class="text-right">{{ number_format($purchaseOrderItem->initial_allocated_budget ?? 0, 0) }}</td>
            </tr>
            <tr>
                <td class="font-bold">Utilization:</td>
                <td class="text-right">{{ number_format($purchaseOrderItem->budget_utilization ?? 0, 0) }}</td>
            </tr>
            <tr>
                <td class="font-bold">Balance Budget:</td>
                <td class="text-right">{{ number_format($purchaseOrderItem->remaining_balance ?? 0, 0) }}</td>
            </tr>
            <tr>
                <td class="font-bold">Current Request:</td>
                <td class="text-right">{{ number_format($purchaseOrderItem->requested_amount ?? 0, 0) }}</td>
            </tr>
            <tr>
                <td class="font-bold">Balance:</td>
                <td class="text-right">{{ number_format($purchaseOrderItem->total_balance_budget ?? 0, 0) }}</td>
            </tr>
            
        </table>
    </div>

    <!-- Sign-off Section -->
    <div class="sign-off">
        <div>
            <p><strong>Approved By:</strong></p>
            <p>Chief Executive Officer ___________________________________</p>
        </div>
    <br><br>
        <table>
            <tr>
                <td><strong>Name & Signature:</strong></td>
                <td>{{ $prepared->first_name }} {{ $prepared->last_name }}</td>
            </tr>
            <tr>
                <td><strong>Date:</strong></td>
                <td>{{ \Carbon\Carbon::parse($purchaseOrder->date)->format('Y-m-d') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
