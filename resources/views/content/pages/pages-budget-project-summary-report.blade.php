@extends('layouts/contentNavbarLayout')

@section('title', 'Project Summary Report')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Summary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
        }

        .section-title .table-header-button {
            margin-left: 10px;
        }

        .status-dropdown {
            position: relative;
            display: inline-block;
        }




        .table-header-button {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            font-size: 0.9em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 4rem;
            font-size: 0.5rem;
        }

        .table-header-button:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border: 1px solid black;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid black;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .col-6 {
            width: 50%;
            padding: 10px;
        }

        .col-12 {
            width: 100%;
            padding: 10px;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .bordered {
            border: 1px solid black;
            padding: 5px;
            border-radius: 5px;
        }

        .overview-box {
            border: 1px solid #000;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #0067aa;
            color: white;
        }

        .budget-box {
            text-align: center;
            border: 2px solid #000;
            padding: 15px;
            background-color: #f1f9ff;
            border-radius: 5px;
            font-size: 1.5em;
        }

        .team-box {
            border: 1px solid #000;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .team-member {
            margin-bottom: 10px;
        }

        .team-member strong {
            display: inline-block;
            width: 150px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .col-6 {
                width: 100%;
            }
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .flex-container>div {
            flex: 1;
            margin: 5px;
        }

        .border-box {
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
        }

        .dropdown {
            margin-bottom: 10px;
        }

        .limited-scroll {
            overflow-x: auto;
        }

        .border-box {
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
        }

        .bordered {
            border: 1px solid black;
            padding: 5px;
            border-radius: 5px;
        }

        .overview-box p {
            margin: 0;
        }

        .overview-box span {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h4>{{@$projects->name}} PROJECT SUMMARY REPORT</h4>

        <div class="flex-container">
            <div>
                <div class="section-title">Project Title: </div>
                <p class="border-box">{{@$projects->name}}</p>
                <div class="section-title">Project Overview:</div>
                <div class="overview-box">
                    The project aimed to improve the overall customer experience by redesigning and enhancing the functionality of our mobile application. The focus was on modernizing the user interface, optimizing performance, and incorporating new features to meet evolving user expectations.
                </div>
            </div>

            <div>
                <div class="section-title">Project Duration:</div>
                <div class="border-box">Start Date: <strong>{{@$budget->start_date}}</strong></div>
                <div class="border-box mt-2">End Date: <strong>{{@$budget->end_date}}</strong></div>

                <div class="section-title mt-2">Project Team:</div>
                <div class="team-box">
                    <div class="team-member"><strong>Client</strong>{{@$clients->clientname}}</div>
                    <div class="team-member"><strong>Business Unit</strong> {{@$units->source}}</div>
                    <div class="team-member"><strong>Project Name</strong>{{@$projects->name}}</div>
                    <div class="team-member"><strong>Reference Code</strong>{{ @$budget->reference_code }}</div>
                </div>
            </div>
        </div>

        <div class="section-title" style="color:red">Direct Cost</div>

        <!-- Salary Costs -->
        <div class="dropdown">
            <div class="section-title">
                Salary
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th>COST PER MONTH</th>
                            <th>NO OF PERSON</th>
                            <th>MONTHS</th>
                            <th>AVERAGE COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->salaries as $salary)
                        <tr>
                            <td>{{ $salary->sn ?? 'no entry' }}</td>
                            <td>{{ $salary->type ?? 'no entry' }}</td>
                            <td>{{ $salary->contract ?? 'no entry' }}</td>
                            <td>{{ $salary->project ?? 'no entry' }}</td>
                            <td>{{ $salary->po ?? 'no entry' }}</td>
                            <td>{{ $salary->expenses ?? 'no entry' }}</td>
                            <td>{{ $salary->description ?? 'no entry' }}</td>
                            <td>{{ $salary->cost_per_month ?? 'no entry' }}</td>
                            <td>{{ $salary->no_of_staff ?? 'no entry' }}</td>
                            <td>{{ $salary->no_of_months ?? 'no entry' }}</td>
                            <td>{{ $salary->average_cost ?? 'no entry' }}</td>
                            <td>{{ $salary->total_cost ?? 'no entry' }}</td>
                            <td>{{ $salary->status ?? 'no entry' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Facility Costs -->
        <div class="dropdown">
            <div class="section-title">
                Facility Cost
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th>COST PER MONTH</th>
                            <th>NO OF PERSON</th>
                            <th>MONTHS</th>
                            <th>AVERAGE COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->facilityCosts as $facility)
                        <tr>
                            <td>{{ $facility->sn ?? 'no entry' }}</td>
                            <td>{{ $facility->type ?? 'no entry' }}</td>
                            <td>{{ $facility->contract ?? 'no entry' }}</td>
                            <td>{{ $facility->project ?? 'no entry' }}</td>
                            <td>{{ $facility->po ?? 'no entry' }}</td>
                            <td>{{ $facility->expenses ?? 'no entry' }}</td>
                            <td>{{ $facility->description ?? 'no entry' }}</td>
                            <td>{{ $facility->cost_per_month ?? 'no entry' }}</td>
                            <td>{{ $facility->no_of_staff ?? 'no entry' }}</td>
                            <td>{{ $facility->no_of_months ?? 'no entry' }}</td>
                            <td>{{ $facility->average_cost ?? 'no entry' }}</td>
                            <td>{{ $facility->total_cost ?? 'no entry' }}</td>
                            <td>{{ $facility->status ?? 'no entry' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Material Costs -->
        <div class="dropdown">
            <div class="section-title">
                Material Cost
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th>COST PER MONTH</th>
                            <th>NO OF PERSON</th>
                            <th>MONTHS</th>
                            <th>AVERAGE COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->materialCosts as $material)
                        <tr>
                            <td>{{ $material->sn ?? 'no entry' }}</td>
                            <td>{{ $material->type ?? 'no entry' }}</td>
                            <td>{{ $material->contract ?? 'no entry' }}</td>
                            <td>{{ $material->project ?? 'no entry' }}</td>
                            <td>{{ $material->po ?? 'no entry' }}</td>
                            <td>{{ $material->expenses ?? 'no entry' }}</td>
                            <td>{{ $material->description ?? 'no entry' }}</td>
                            <td>{{ $material->quantity ?? 'no entry' }}</td>
                            <td>{{ $material->unit ?? 'no entry' }}</td>
                            <td>{{ $material->unit_cost ?? 'no entry' }}</td>
                            <td>{{ $material->total_cost ?? 'no entry' }}</td>
                            <td>{{ $material->average_cost ?? 'no entry' }}</td>
                            <td>{{ $material->status ?? 'no entry' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section-title" style="color:red">In Direct Cost</div>
        <!-- Overhead Costs -->
        <div class="dropdown">
            <div class="section-title">
                Overhead Cost
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th>COST PER MONTH</th>
                            <th>NO OF PERSON</th>
                            <th>MONTHS</th>
                            <th>AVERAGE COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->costOverheads as $costOverhead)
                        <tr>
                            <td>{{$costOverhead->sn}}</td>
                            <td>{{$costOverhead->type}}</td>
                            <td>{{$costOverhead->contract}}</td>
                            <td>{{$costOverhead->project}}</td>
                            <td>{{$costOverhead->po}}</td>
                            <td>{{$costOverhead->expenses}}</td>
                            <td>{{$costOverhead->description}}</td>
                            <td>{{$costOverhead->cost_per_month}}</td>
                            <td>{{$costOverhead->no_of_staff}}</td>
                            <td>{{$costOverhead->no_of_months}}</td>
                            <td>{{$costOverhead->average_cost}}</td>
                            <td>{{$costOverhead->total_cost}}</td>
                            <td>{{$costOverhead->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Financial Costs -->
        <div class="dropdown">
            <div class="section-title">
                Financial Cost
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th>COST PER MONTH</th>
                            <th>NO OF PERSON</th>
                            <th>MONTHS</th>
                            <th>AVERAGE COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->financialCosts as $financialCost)
                        <tr>
                            <td>{{$financialCost->sn}}</td>
                            <td>{{$financialCost->type}}</td>
                            <td>{{$financialCost->contract}}</td>
                            <td>{{$financialCost->project}}</td>
                            <td>{{$financialCost->po}}</td>
                            <td>{{$financialCost->expenses}}</td>
                            <td>{{$financialCost->description}}</td>
                            <td>{{$financialCost->cost_per_month}}</td>
                            <td>{{$financialCost->no_of_staff}}</td>
                            <td>{{$financialCost->no_of_months}}</td>
                            <td>{{$financialCost->average_cost}}</td>
                            <td>{{$financialCost->total_cost}}</td>
                            <td>{{$financialCost->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section-title" style="color:red">Revenue & Profit</div>
        <!-- Revenue Table -->
        <div class="dropdown">
            <div class="section-title">
                Revenue
                <button class="table-header-button">UPDATE</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TYPE</th>
                            <th>CONTRACT</th>
                            <th>PROJECT</th>
                            <th>DESCRIPTION</th>
                            <th>AMOUNT</th>
                            <th>TOTAL PROFIT</th>
                            <th>NET PROFIT BEFORE TAX</th>
                            <th>TAX</th>
                            <th>NET PROFIT AFTER TAX</th>
                            <th>PROFIT PERCENTAGE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    @php
                    $total_profit_after_tax=0;
                    @endphp
                    <tbody>
                        @foreach($budget->revenuePlans as $revenuePlan)
                        <tr>
                            <td>{{$revenuePlan->sn}}</td>
                            <td>{{$revenuePlan->type}}</td>
                            <td>{{$revenuePlan->contract}}</td>
                            <td>{{$revenuePlan->project}}</td>
                            <td>{{$revenuePlan->description}}</td>
                            <td>{{$revenuePlan->amount}}</td>
                            <td>{{$revenuePlan->total_profit}}</td>
                            <td>{{$revenuePlan->net_profit_before_tax}}</td>
                            <td>{{$revenuePlan->tax}}</td>
                            <td>{{$revenuePlan->net_profit_after_tax}}</td>
                            <td>{{$revenuePlan->profit_percentage}}</td>
                            <td>{{$revenuePlan->profit_percentage}}</td>
                        </tr>
                    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profit Table -->
        <div class="dropdown">
            <div class="section-title">Profit</div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Profit Source</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add rows here -->
                        <td>Net Profit After Tax</td>
                        <td>{{$totalNetProfitAfterTax}} AED</td>
                    </tbody>
                </table>
            </div>
        </div>
        @php
        $totalOPEX = $totalDirectCost + $totalInDirectCost + $totalNetProfitBeforeTax;
        @endphp
        <!-- Cash Management Table -->
        <div class="dropdown">
            <div class="section-title" style="color:red">Cash Management</div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>HEAD</th>
                            <th>AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add rows here -->
                        <tr>
                            <td>1</td>
                            <td>Cash Requirement For CAPEX</td>
                            <td>{{number_format($totalCapitalExpenditure)}} AED</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Cash Requirement For OPEX</td>
                            <td>{{ number_format($totalOPEX) }} AED</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total CAPEX, OPEX, and Total Cost -->
        <div class="section-title" style="color:red">Summary:</div>
        <div class="flex-container">
            <div class="bordered">
                <div class="section-title">Total CAPEX:</div>
                <p>{{number_format($totalCapitalExpenditure)}} AED</p>
            </div>
            <div class="bordered">
                <div class="section-title">Total OPEX:</div>
                <p>{{ number_format($totalOPEX) }} AED</p>
            </div>
            <div class="bordered">
                <div class="section-title">Total Cost:</div>
                <p> {{number_format($totalOPEX + $totalCapitalExpenditure)}} AED</p>
            </div>
        </div>


        <!-- Total CAPEX, OPEX, and Total Cost -->
        <div class="section-title mt-2" style="color:red">Budget Allocated</div>
        <div class="flex-container">
            <div class="bordered">
                <div class="section-title"></div>
                <p>{{number_format($budget->total_budget_allocated)}} </p>
            </div>
        </div>

        <div class="status-dropdown mt-4">
            <form action="{{route('approve-status')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <select class="form-select" name="status">
                            <option value="" disabled selected>Choose Approval</option>
                            <option value="pending">Pending</option>
                            <option value="hold">Hold</option>
                            <option value="reject">Reject</option>
                            <option value="approve">Approve</option>
                        </select>
                    </div>
                    @error('status')
                    <div class=" text-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="project_id" value="{{$id}}">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>




</body>

</html>

@endsection