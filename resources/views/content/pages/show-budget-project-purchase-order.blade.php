<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>

<div class="container">
      <!-- Download Button -->
      <div class="text-end mt-4">
        <a href="{{ route('download.pdf') }}" class="btn btn-primary">
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
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">30 August 2024</td>
                    </tr>
                    <tr style="border:2px solid black">
                        <td class="label" style="color:black; border:1px solid black">PO #</td>
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">5415</td>
                    </tr>
                    <tr style="border:2px solid black">
                        <td class="label" style="color:black; border:1px solid black">Payment Term</td>
                        <td class="value" style="text-align:left; padding: 8px; width:60%; color:black">Cheque 60 Days</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div>
                <h6 class="bg-primary text-white p-2">Supplier Detail</h6>
                <p><strong>Name:</strong> Frontier Innovation General Trading</p>
                <p><strong>Address:</strong> Dubai, UAE</p>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <h6 class="bg-primary text-white p-2">Project Detail</h6>
                <p><strong>Project:</strong> DU SFAN Civil</p>
                <p><strong>Requested By:</strong> Naveed Ahmed</p>
                <p><strong>Verified By:</strong> Ansar Abbasi, Abdul Khalig</p>
                <p><strong>Prepared By:</strong> Naman Tahir</p>
            </div>
        </div>
    </div>

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
            <tbody>
                <tr>
                    <td>XAD001627</td>
                    <td>JRC 04 Precast With Frame Cover & Accessories (DU Standard)</td>
                    <td>3</td>
                    <td>1,470.00</td>
                    <td>4,410.00</td>
                </tr>
                <tr>
                    <td>XAD001628</td>
                    <td>JRC 12 Precast With Frame Cover & Accessories (DU Standard)</td>
                    <td>10</td>
                    <td>3,185.00</td>
                    <td>31,850.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                    <td>36,260.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Discount</strong></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>VAT 5%</strong></td>
                    <td>1,813.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td>38,073.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="budget-verification-box">
        <h5>Budget Department Verification</h5>
        <table>
            <tr>
                <td class="label">Total Budget:</td>
                <td class="value">412,705</td>
            </tr>
            <tr>
                <td class="label">Utilization:</td>
                <td class="value">48,082</td>
            </tr>
            <tr>
                <td class="label">Balance Budget:</td>
                <td class="value">362,624</td>
            </tr>
            <tr>
                <td class="label">Current Request:</td>
                <td class="value">38,073</td>
            </tr>
            <tr>
                <td class="label">Balance:</td>
                <td class="value">326,551</td>
            </tr>
        </table>
        <div class="signature-box mt-3">
            <table>
                <tr>
                    <td class="signature-line">Sandhya</td>
                    <td class="signature-line">20-08-2024</td>
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

</body>
</html>