{{-- resources/views/trial_balance.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unadjusted Trial Balance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            max-width: 80%;
            margin: 0 auto;
            margin-top: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            padding: 1.5rem;
            position: relative;
        }
        .table-title {
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .table-subtitle {
            text-align: center;
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        .trial-balance-table th, .trial-balance-table td {
            text-align: right;
            vertical-align: middle;
            padding: 0.75rem;
        }
        .trial-balance-table th {
            background-color: #0067aa;
            color: #ffffff;
        }
        .trial-balance-table .account-name {
            text-align: left;
        }
        .trial-balance-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table-footer {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .home-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <a href="{{ route('add-opening-balance') }}" class="btn btn-primary home-button">Home</a> <!-- Home button added here -->
        
        <div class="table-title">XAD Technologies LLC</div>
        <div class="table-subtitle">{{$bank->bank_name}}<br>{{$bank->bank_address}}</div>

        <div class="table-responsive">
            <table class="table table-bordered trial-balance-table">
                <thead>
                    <tr>
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="account-name">Cash</td>
                        <td>24,550</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Consulting fees receivable</td>
                        <td>11,700</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Prepaid office rent</td>
                        <td>3,150</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Prepaid dues and subscriptions</td>
                        <td>150</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Supplies</td>
                        <td>300</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Equipment</td>
                        <td>18,000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Accumulated depreciation - equipment</td>
                        <td></td>
                        <td>5,100</td>
                    </tr>
                    <tr>
                        <td class="account-name">Notes payable</td>
                        <td></td>
                        <td>2,500</td>
                    </tr>
                    <tr>
                        <td class="account-name">Income taxes payable</td>
                        <td></td>
                        <td>6,000</td>
                    </tr>
                    <tr>
                        <td class="account-name">Unearned consulting fees</td>
                        <td></td>
                        <td>2,975</td>
                    </tr>
                    <tr>
                        <td class="account-name">Capital stock</td>
                        <td></td>
                        <td>15,000</td>
                    </tr>
                    <tr>
                        <td class="account-name">Retained earnings</td>
                        <td></td>
                        <td>16,350</td>
                    </tr>
                    <tr>
                        <td class="account-name">Dividends</td>
                        <td>30,000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Consulting fees earned</td>
                        <td></td>
                        <td>128,590</td>
                    </tr>
                    <tr>
                        <td class="account-name">Salaries expense</td>
                        <td>44,410</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Telephone expense</td>
                        <td>1,275</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Rent expense</td>
                        <td>11,000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Income tax expense</td>
                        <td>25,500</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Dues and subscription expense</td>
                        <td>280</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Supplies expense</td>
                        <td>800</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Depreciation expense - equipment</td>
                        <td>3,300</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="account-name">Miscellaneous expenses</td>
                        <td>2,100</td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="table-footer">
                        <td class="account-name">Totals</td>
                        <td>176,515</td>
                        <td>176,515</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
