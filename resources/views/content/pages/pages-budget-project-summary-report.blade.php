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

        .status-dropdown select {
            appearance: none;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            font-size: 1em;
            cursor: pointer;
            width: 150px;
            transition: border-color 0.3s ease;
        }

        .status-dropdown select:focus {
            border-color: #0067aa;
            outline: none;
        }

        .status-dropdown::after {
            content: "▼";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 0.8em;
            color: #333;
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
            width:4rem;
            font-size:0.5rem;
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

        table th, table td {
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

        .flex-container > div {
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
    <h4>BUDGET PROJECT SUMMARY REPORT</h4>

    <div class="flex-container">
        <div>
            <div class="section-title">Project Title:</div>
            <p class="border-box">Mobile App Redesign</p>
            <div class="section-title">Project Overview:</div>
            <div class="overview-box">
                The project aimed to improve the overall customer experience by redesigning and enhancing the functionality of our mobile application. The focus was on modernizing the user interface, optimizing performance, and incorporating new features to meet evolving user expectations.
            </div>
        </div>

        <div>
            <div class="section-title">Project Duration:</div>
            <div class="border-box">Start Date: <strong>March 1, 2023</strong></div>
            <div class="border-box mt-2">End Date: <strong>September 30, 2023</strong></div>
            
            <div class="section-title mt-2">Project Team:</div>
            <div class="team-box">
                <div class="team-member"><strong>Client</strong>Huwawei</div>
                <div class="team-member"><strong>Business Unit</strong> Outsource</div>
                <div class="team-member"><strong>Project Name</strong>713H</div>
                <div class="team-member"><strong>Reference Code</strong>BP09032024001</div>
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
                <!-- Add rows here -->
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
                <!-- Add rows here -->
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
                <!-- Add rows here -->
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
                <!-- Add rows here -->
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
                <!-- Add rows here -->
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
                <tbody>
                <!-- Add rows here -->
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
                 <td>10098.00 AED</td> 
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cash Management Table -->
    <div class="dropdown">
        <div class="section-title"  style="color:red">Cash Management</div>
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
                  <td>10098.00 AED</td> 
                </tr>
                <tr>
                  <td>2</td> 
                  <td>Cash Requirement For OPEX</td>
                  <td>10098.00 AED</td> 
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Total CAPEX, OPEX, and Total Cost -->
    <div class="section-title"  style="color:red">Summary:</div>
    <div class="flex-container">
        <div class="bordered">
            <div class="section-title">Total CAPEX:</div>
            <p>$25,000.00</p>
        </div>
        <div class="bordered">
            <div class="section-title">Total OPEX:</div>
            <p>$10,000.00</p>
        </div>
        <div class="bordered">
            <div class="section-title">Total Cost:</div>
            <p>$35,000.00</p>
        </div>
    </div>

    
    <!-- Total CAPEX, OPEX, and Total Cost -->
    <div class="section-title mt-2"  style="color:red">Budget Allocated</div>
    <div class="flex-container">
        <div class="bordered">
            <div class="section-title"></div>
            <p>$25,000.00</p>
        </div>
    </div>

    <div class="status-dropdown mt-4">
        <select>
            <option value="" disabled selected>Choose Approval</option>
            <option value="pending">Pending</option>
            <option value="hold">Hold</option>
            <option value="reject">Reject</option>
            <option value="approve">Approve</option>
        </select>
    </div>

    <div class="row footer">
        <div class="col-6">
            <div class="section-title">Achievements:</div>
            <ul>
                <li>Successful Launch: The redesigned app was successfully launched on schedule.</li>
                <li>Increased User Engagement: Achieved a 95% positive feedback rate from early users.</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">Key Metrics:</div>
            <ul>
                <li>Completed: 4 tasks</li>
                <li>Pending: 3 tasks</li>
            </ul>
        </div>
    </div>
</div>



</body>
</html>

@endsection

