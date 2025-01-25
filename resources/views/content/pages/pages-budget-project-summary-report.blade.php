@extends('layouts/contentNavbarLayout')

@section('title', 'Project Summary Report')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Summary Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            /* Professional serif font */
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        .status-dropdown {
            width: 120px;
            /* Increased width for more space */
            padding: 10px 15px;
            /* Increased padding for more room inside */
            font-size: 12px;
            /* Larger font for better readability */
            border-radius: 6px;
            border: 1px solid #0067aa;
            /* Border color */
            background-color: #f9f9f9;
            /* Light background */
            color: #333;
            /* Text color */
            transition: all 0.3s ease;
        }

        .status-dropdown:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 103, 170, 0.5);
            /* Focus effect */
        }

        .section-title {
            display: flex;
            align-items: center;
            color: black;
            font-weight: bolder;
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
            background-color: #0067aa;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 5rem;
            font-size: 0.8rem;
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

        /* Modal Height */
        .modal-dialog {
            max-height: 550px;
            /* Set maximum height for the modal */
            height: 550px;
            display: flex;
            align-items: center;
        }

        .modal-content {
            height: 100%;
        }

        /* Custom Scrollbar Styles */
        .modal-body {
            /* Custom scrollbar for Webkit browsers (Chrome, Safari) */
            overflow-x: auto;
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: #0067aa #e0e0e0;
            /* For Firefox */
        }

        .modal-body::-webkit-scrollbar {
            width: 8px;
            /* Width of the scrollbar */
        }

        .modal-body::-webkit-scrollbar-thumb {
            background-color: #0067aa;
            /* Color of the scrollbar thumb */
            border-radius: 4px;
            /* Optional: Rounded corners for the scrollbar thumb */
        }

        .modal-body::-webkit-scrollbar-track {
            background-color: #e0e0e0;
            /* Color of the scrollbar track */
        }
    </style>
</head>

<body>

    @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h4>{{ $projects->name ?? 'N/A' }} PROJECT SUMMARY REPORT</h4>

        <div class="flex-container">
            <div>
                <div class="section-title">Project Title: </div>
                <p class="border-box">{{ $projects->name ?? 'N/A' }} </p>
                <div class="section-title">Project Overview:</div>
                <div class="overview-box">
                    The project aimed to improve the overall customer experience by redesigning and enhancing the
                    functionality of our mobile application. The focus was on modernizing the user interface, optimizing
                    performance, and incorporating new features to meet evolving user expectations.
                </div>
            </div>

            <div>
                <div class="section-title">Project Duration:</div>
                <div class="border-box">Start Date: <strong>{{ $budget->start_date ?? 'N/A' }}</strong></div>
                <div class="border-box mt-2">End Date: <strong>{{ $budget->end_date ?? 'N/A' }}</strong></div>

                <div class="section-title mt-2">Project Team:</div>
                <div class="team-box">
                    <div class="team-member"><strong>Client</strong> {{ $clients->clientname ?? 'N/A' }}</div>
                    <div class="team-member"><strong>Business Unit</strong> {{ $units->source ?? 'N/A' }}</div>
                    <div class="team-member"><strong>Project Name</strong> {{ $projects->name ?? 'N/A' }}</div>
                    <div class="team-member"><strong>Reference Code</strong> {{ $budget->reference_code ?? 'N/A' }}</div>
                    <div class="team-member"><strong>Approval Status</strong>
                        <span style="color:green; font-weight:bold">{{ $budget->approval_status ?? 'N/A' }}</span>
                    </div>
                    <div class="team-member">
                        <strong>Budget Summary</strong>
                        {{-- Example: Only if approved, show download PDF button --}}
                        <a href="{{ route('download.budgetSummary', ['POID' => $budget->id ?? 0]) }}" target="_blank"
                            class="btn btn-sm" style="background-color:#1a73e8; color:white">
                            <i class="fas fa-print"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-title" style="color:red">Direct Cost</div>

        <!-- Salary Costs -->
        <div class="dropdown">
            <div class="section-title">
                Salary
                <button class="table-header-button">{{ number_format($totalSalary ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
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
                            <th>VISA STATUS</th>
                            <th>%</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->salaries ?? [] as $salary)
                            <tr>
                                <td>{{ $salary->type ?? 'no entry' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $salary->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $salary->po ?? 'no entry' }}</td>
                                <td>{{ $salary->expenses ?? 'no entry' }}</td>
                                <td>{{ $salary->description ?? 'no entry' }}</td>
                                <td>{{ number_format($salary->cost_per_month ?? 0, 0) }}</td>
                                <td>{{ $salary->no_of_staff ?? 0 }}</td>
                                <td>{{ $salary->no_of_months ?? 0 }}</td>
                                <td>{{ number_format($salary->average_cost ?? 0, 0) }}</td>
                                <td>{{ number_format($salary->total_cost ?? 0, 0) }}</td>
                                <td>{{ $salary->status ?? 'no entry' }}</td>
                                <td>{{ $salary->visa_status ?? 'no entry' }}</td>
                                <td>{{ $salary->percentage_cost ?? 0 }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('delete.salary', $salary->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name='isajax' value="false">
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal-{{ $salary->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
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
                <button class="table-header-button">{{ number_format($totalFacilityCost ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
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
                            <th>%</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->facilityCosts ?? [] as $facility)
                            <tr>
                                <td>{{ $facility->type ?? 'no entry' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $facility->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $facility->po ?? 'no entry' }}</td>
                                <td>{{ $facility->expenses ?? 'no entry' }}</td>
                                <td>{{ $facility->description ?? 'no entry' }}</td>
                                <td>{{ number_format($facility->cost_per_month ?? 0, 0) }}</td>
                                <td>{{ $facility->no_of_staff ?? 0 }}</td>
                                <td>{{ $facility->no_of_months ?? 0 }}</td>
                                <td>{{ number_format($facility->average_cost ?? 0, 0) }}</td>
                                <td>{{ number_format($facility->total_cost ?? 0, 0) }}</td>
                                <td>{{ $facility->status ?? 'no entry' }}</td>
                                <td>{{ $facility->percentage_cost ?? 0 }}</td>

                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('delete.facility', $facility->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal-{{ $facility->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Material Costs -->
        <div class="dropdown">
            <div class="section-title" style="padding: 15px; background: #f4f4f4; border: 1px solid #ddd; border-radius: 5px; width: 100%;display:block">
                <div>
                    <h5 style="margin-bottom: 10px; color: #444; font-weight: bold; font-size: 16px;">Total Material Cost</h5>
                    <button class="table-header-button" style="background: #0067aa; color: #fff; border: none; padding: 5px 15px; border-radius: 4px; font-size: 14px; font-weight: bold;">
                        {{ number_format(
                            ($totalMaterialCost ?? 0)
                            + ($existingPettyCash?->amount ?? 0)
                            + ($existingNocPayment?->amount ?? 0)
                            + ($existingSubcon?->amount ?? 0)
                            + ($existingThirdparty?->amount ?? 0),
                            0
                        ) }}
                    </button>    
                </div>
                
                <ul style="margin-top: 10px; padding: 0; list-style: none;">
                    <li style="margin-bottom: 3px; font-size: 13px; color: #555;">
                        <strong>Material :</strong> {{ number_format($totalMaterialCost ?? 0, 0) }}
                    </li>
                    <li style="margin-bottom: 3px; font-size: 13px; color: #555;">
                        <strong>Petty Cash Fund:</strong> {{ number_format($existingPettyCash?->amount ?? 0, 0) }}
                    </li>
                    <li style="margin-bottom: 3px; font-size: 13px; color: #555;">
                        <strong>NOC Payment:</strong> {{ number_format($existingNocPayment?->amount ?? 0, 0) }}
                    </li>
                    <li style="margin-bottom: 3px; font-size: 13px; color: #555;">
                        <strong>SubContractor Payment:</strong> {{ number_format($existingSubcon?->amount ?? 0, 0) }}
                    </li>
                    <li style="margin-bottom: 3px; font-size: 13px; color: #555;">
                        <strong>Third Party Payment:</strong> {{ number_format($existingThirdparty?->amount ?? 0, 0) }}
                    </li>
                </ul>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE HEAD</th>
                            <th>DESCRIPTION</th>
                            <th>QUANTITY</th>
                            <th>UNIT</th>
                            <th>UNIT COST</th>
                            <th>TOTAL COST</th>
                            <th>AVERAGE COST</th>
                            <th>STATUS</th>
                            <th>%</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->materialCosts ?? [] as $material)
                            <tr>
                                <td>{{ $material->type ?? 'no entry' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $material->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $material->po ?? 'no entry' }}</td>
                                <td>{{ $material->expenses ?? 'no entry' }}</td>
                                <td>{{ $material->description ?? 'no entry' }}</td>
                                <td>{{ number_format($material->quantity ?? 0, 0) }}</td>
                                <td>{{ $material->unit ?? 'no entry' }}</td>
                                <td>{{ number_format($material->unit_cost ?? 0, 0) }}</td>
                                <td>{{ number_format($material->total_cost ?? 0, 0) }}</td>
                                <td>{{ number_format($material->average_cost ?? 0, 0) }}</td>
                                <td>{{ $material->status ?? 'no entry' }}</td>
                                <td>{{ $material->percentage_cost ?? 0 }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('delete.material', $material->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateMaterialModal-{{ $material->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
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
                <button class="table-header-button">{{ number_format($totalCostOverhead ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>AMOUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->costOverheads ?? [] as $costOverhead)
                            <tr>
                                <td>{{ $costOverhead->type ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $costOverhead->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $costOverhead->po ?? 'N/A' }}</td>
                                <td>{{ $costOverhead->expenses ?? 'N/A' }}</td>
                                <td>{{ number_format($costOverhead->amount ?? 0, 0) }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('delete.costOverhead', $costOverhead->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateOverHeadCostModal-{{ $costOverhead->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
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
                <button class="table-header-button">{{ number_format($totalFinancialCost ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>AMOUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->financialCosts ?? [] as $financialCost)
                            <tr>
                                <td>{{ $financialCost->type ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $financialCost->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $financialCost->po ?? 'N/A' }}</td>
                                <td>{{ $financialCost->expenses ?? 'N/A' }}</td>
                                <td>{{ number_format($financialCost->total_cost ?? 0, 0) }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST"
                                        action="{{ route('delete.financialCost', $financialCost->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal-{{ $financialCost->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Capital Expenditure -->
        <div class="section-title" style="color:red">Capital Expenditure</div>

        <div class="dropdown">
            <div class="section-title">
                Capital Expenditure
                <button class="table-header-button">{{ number_format($totalCapitalExpenditure ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>PROJECT</th>
                            <th>PO</th>
                            <th>EXPENSE</th>
                            <th>DESCRIPTION</th>
                            <th> QUANTITY</th>
                            <th>COST</th>
                            <th>TOTAL COST</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->capitalExpenditures ?? [] as $capital)
                            <tr>
                                <td>{{ $capital->type ?? 'no entry' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $capital->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $capital->po ?? 'no entry' }}</td>
                                <td>{{ $capital->expenses ?? 'no entry' }}</td>
                                <td>{{ $capital->description ?? 'no entry' }}</td>
                                <td>{{ number_format($capital->total_number ?? 0, 0) }}</td>
                                <td>{{ number_format($capital->cost ?? 0, 0) }}</td>
                                <td>{{ number_format($capital->total_cost ?? 0, 0) }}</td>
                                <td>{{ $capital->status ?? 'no entry' }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST"
                                        action="{{ route('delete.capitalExpenditure', $capital->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateCapitalModal-{{ $capital->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
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
                Total Revenue
                <button class="table-header-button">{{ number_format($totalRevenue ?? 0, 0) }}</button>
            </div>
            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>PROJECT</th>
                            <th>DESCRIPTION</th>
                            <th>AMOUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget->revenuePlans ?? [] as $revenuePlan)
                            <tr>
                                <td>{{ $revenuePlan->type ?? 'no entry' }}</td>
                                <td>
                                    @php
                                        $project = $allProjects->where('id', $revenuePlan->project)->first();
                                    @endphp
                                    {{ $project->name ?? 'N/A' }}
                                </td>
                                <td>{{ $revenuePlan->description ?? 'no entry' }}</td>
                                <td>{{ number_format($revenuePlan->amount ?? 0, 0) }}</td>
                                <td>
                                    <!-- Delete Form -->
                                    <form method="POST"
                                        action="{{ route('delete.deleteRevenue', $revenuePlan->id ?? 0) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Update Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editRevenuePlan-{{ $revenuePlan->id ?? 0 }}">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Profit Table -->
        <div class="dropdown">
            <div class="section-title" style="color:red">Profit</div>

            <div class="table-responsive text-nowrap limited-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Profit Source</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>Net Profit After Tax</td>
                        <td>
                            <a href="{{ route('download.budgetSummary', ['POID' => $budget->id ?? 0]) }}" target="_blank"
                                class="btn btn-sm" style="background-color:#1a73e8; color:white">
                                <i class="fas fa-print"></i> Summary Report
                            </a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>

        @php
            $totalOPEX = ($totalDirectCost ?? 0) + ($totalInDirectCost ?? 0) + ($totalNetProfitBeforeTax ?? 0);
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
                            <td>{{ number_format($totalCapitalExpenditure ?? 0, 0) }} AED</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Cash Requirement For OPEX</td>
                            <td>{{ number_format($totalDirectCost ?? 0, 0) }} AED</td>
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
                <p>{{ number_format($totalCapitalExpenditure ?? 0, 0) }} AED</p>
            </div>
            <div class="bordered">
                <div class="section-title">Total OPEX:</div>
                <p>{{ number_format($totalDirectCost ?? 0, 0) }} AED</p>
            </div>
            <div class="bordered">
                <div class="section-title">Total Cost:</div>
                <p>{{ number_format(
                    ($totalDirectCost ?? 0)
                    + ($totalCapitalExpenditure ?? 0)
                    + ($totalInDirectCost ?? 0),
                    0
                ) }}
                </p>
            </div>
        </div>


        <!-- Total CAPEX, OPEX, and Total Cost -->
        <div class="section-title mt-2" style="color:red">Budget Allocated</div>
        <div class="flex-container">
            <div class="bordered">
                <div class="section-title"></div>
                <p>{{ number_format($budget->total_budget_allocated ?? 0, 0) }}</p>
            </div>
        </div>


        <form action="{{ route('approve-status') }}" method="post">
            @csrf
            <div class="row gy-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Approval Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value="" disabled selected>Choose Approval</option>
                        <option value="pending">Pending</option>
                        <option value="hold">Hold</option>
                        <option value="reject">Reject</option>
                        <option value="approve">Approve</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="project_id" value="{{ $id ?? 0 }}">
                <input type="hidden" name="total_salary" value="{{ $totalSalary ?? 0 }}">
                <input type="hidden" name="total_facility_cost" value="{{ $totalFacilityCost ?? 0 }}">
                <input type="hidden" name="total_material_cost" value="{{ $totalMaterialCost ?? 0 }}">
                <input type="hidden" name="total_cost_overhead" value="{{ $totalCostOverhead ?? 0 }}">
                <input type="hidden" name="total_financial_cost" value="{{ $totalFinancialCost ?? 0 }}">
                <input type="hidden" name="total_capital_expenditure" value="{{ $totalCapitalExpenditure ?? 0 }}">
                <input type="hidden" name="total_cost" value="{{ ($totalOPEX ?? 0) + ($totalDirectCost ?? 0) }}">
                <input type="hidden" name="expected_net_profit_after_tax" value="{{ $totalNetProfitAfterTax ?? 0 }}">
                <input type="hidden" name="expected_net_profit_before_tax" value="{{ $totalNetProfitBeforeTax ?? 0 }}">
                <input type="hidden" name="reference_code" value="{{ $budget->reference_code ?? '' }}">
                <input type="hidden" name="client" value="{{ $clients->id ?? '' }}">
                <input type="hidden" name="source" value="{{ $units->id ?? '' }}">
                <input type="hidden" name="project" value="{{ $projects->id ?? '' }}">

                <div class="col-md-12 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" style="background-color:#0067aa; hover:#0067aa">Submit</button>
                </div>
            </div>
        </form>


        @if (($budget->approval_status ?? '') === 'approve')
            <form action="{{ route('budget.allocate') }}" method="GET">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"
                            style="background-color:#0067aa; border-color:#0067aa">Allocate Budget</button>
                        <input type="hidden" name="reference_code" value="{{ $budget->reference_code ?? '' }}">
                    </div>
                </div>
            </form>
        @endif

        <!-- Salary Update Modals -->
        @foreach ($salaries ?? [] as $salary)
            <div class="modal fade" id="updateModal-{{ $salary->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateModalLabel-{{ $salary->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel-{{ $salary->id ?? 0 }}">Update Salary</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateSalaryForm-{{ $salary->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-salary/' . ($salary->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="Salary" {{ ($salary->type ?? '') == 'Salary' ? 'selected' : '' }}>
                                            Salary
                                        </option>
                                        <option value="Other" {{ ($salary->type ?? '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="project" class="form-label">Project</label>
                                    <select class="form-select" id="project" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($salary->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="po" class="form-label">PO Type</label>
                                    <select class="form-select" id="po" name="po" required>
                                        <option value="CAPEX" {{ ($salary->po ?? '') == 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX" {{ ($salary->po ?? '') == 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="expense" class="form-label">Expense Head</label>
                                    <input type="text" class="form-control" id="expense" name="expenses"
                                           value="{{ $salary->expenses ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="cost_per_month" class="form-label">Cost Per Month</label>
                                    <input type="number" class="form-control" id="cost_per_month"
                                           name="cost_per_month"
                                           value="{{ $salary->cost_per_month ?? 0 }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           value="{{ $salary->description ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                           value="{{ $salary->status ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="noOfPerson" class="form-label">No Of Persons</label>
                                    <input type="number" class="form-control" id="noOfPerson" name="no_of_staff"
                                           value="{{ $salary->no_of_staff ?? 0 }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="months" class="form-label">Months</label>
                                    <input type="number" class="form-control" id="months" name="no_of_months"
                                           value="{{ $salary->no_of_months ?? 0 }}" required>
                                </div>
                                <input type="hidden" name="isajax" value="false">
                                <button type="submit" class="btn btn-primary">Update Salary</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Facility Update Modals -->
        @foreach ($facilities ?? [] as $facility)
            <div class="modal fade" id="updateModal-{{ $facility->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateModalLabel-{{ $facility->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel-{{ $facility->id ?? 0 }}">Update Facility Cost</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateFacilitiesForm-{{ $facility->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-facility-cost/' . ($facility->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="Facility Cost"
                                            {{ ($facility->type ?? '') == 'Facility Cost' ? 'selected' : '' }}>
                                            Facility Cost
                                        </option>
                                        <option value="Other"
                                            {{ ($facility->type ?? '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="project" class="form-label">Project</label>
                                    <select class="form-select" id="project" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($facility->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="po" class="form-label">PO</label>
                                    <select class="form-select" id="po" name="po" required>
                                        <option value="CAPEX"
                                            {{ ($facility->po ?? '') == 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX"
                                            {{ ($facility->po ?? '') == 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expense" class="form-label">Expense Head</label>
                                    <input type="text" class="form-control" id="expense" name="expense"
                                           value="{{ $facility->expenses ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cost_per_month" class="form-label">Cost Per Month</label>
                                    <input type="number" class="form-control" id="cost_per_month"
                                           name="cost_per_month"
                                           value="{{ $facility->cost_per_month ?? 0 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           value="{{ $facility->description ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                           value="{{ $facility->status ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noOfPerson" class="form-label">No Of Person</label>
                                    <input type="number" class="form-control" id="noOfPerson" name="no_of_staff"
                                           value="{{ $facility->no_of_staff ?? 0 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="months" class="form-label">Months</label>
                                    <input type="number" class="form-control" id="months" name="no_of_months"
                                           value="{{ $facility->no_of_months ?? 0 }}" required>
                                </div>
                                <input type="hidden" name="project_id" value="{{ $budget->id ?? 0 }}">
                                <button type="submit" class="btn btn-primary">Update Facilities Cost</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Material Update Modals -->
        @foreach ($materials ?? [] as $material)
            <div class="modal fade" id="updateMaterialModal-{{ $material->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateMaterialModalLabel-{{ $material->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateMaterialModalLabel-{{ $material->id ?? 0 }}">Update
                                Material Cost</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateMaterialForm-{{ $material->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-material/' . ($material->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="Material"
                                            {{ ($material->type ?? '') == 'Material' ? 'selected' : '' }}>
                                            Material
                                        </option>
                                        <option value="Other"
                                            {{ ($material->type ?? '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="project" class="form-label">Project</label>
                                    <select class="form-select" id="project" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($material->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="po" class="form-label">PO</label>
                                    <select class="form-select" id="po" name="po" required>
                                        <option value="CAPEX"
                                            {{ ($material->po ?? '') == 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX"
                                            {{ ($material->po ?? '') == 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expense" class="form-label">Expense Head</label>
                                    <input type="text" class="form-control" id="expense" name="expense"
                                           value="{{ $material->expenses ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                           step="any" value="{{ $material->quantity ?? 0 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select" id="unit" name="unit" required>
                                        <option value="meters"
                                            {{ ($material->unit ?? '') == 'meters' ? 'selected' : '' }}>
                                            Meters
                                        </option>
                                        <option value="feet"
                                            {{ ($material->unit ?? '') == 'feet' ? 'selected' : '' }}>
                                            Feet
                                        </option>
                                        <option value="rolls"
                                            {{ ($material->unit ?? '') == 'rolls' ? 'selected' : '' }}>
                                            Rolls
                                        </option>
                                        <option value="pieces"
                                            {{ ($material->unit ?? '') == 'pieces' ? 'selected' : '' }}>
                                            Pieces
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="unit_cost" class="form-label">Unit Cost</label>
                                    <input type="number" class="form-control" id="unit_cost" name="unit_cost"
                                           step="any" value="{{ $material->unit_cost ?? 0 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           value="{{ $material->description ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                           value="{{ $material->status ?? '' }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Material Cost</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Cost Overhead Update Modals -->
        @foreach ($overheads ?? [] as $costOverhead)
            <div class="modal fade" id="updateOverHeadCostModal-{{ $costOverhead->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateOverHeadCostModalLabel-{{ $costOverhead->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateOverHeadCostModalLabel-{{ $costOverhead->id ?? 0 }}">
                                Update Cost Overhead
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateOverHeadCostForm-{{ $costOverhead->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-overhead-cost/' . ($costOverhead->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type-{{ $costOverhead->id ?? 0 }}" class="form-label">Type</label>
                                    <select class="form-select" id="type-{{ $costOverhead->id ?? 0 }}" name="type" required>
                                        <option value="overhead cost"
                                            {{ ($costOverhead->type ?? '') === 'overhead cost' ? 'selected' : '' }}>
                                            Overhead Cost
                                        </option>
                                        <option value="Other"
                                            {{ ($costOverhead->type ?? '') === 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="project-{{ $costOverhead->id ?? 0 }}" class="form-label">Project</label>
                                    <select class="form-select" id="project-{{ $costOverhead->id ?? 0 }}" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($costOverhead->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="po-{{ $costOverhead->id ?? 0 }}" class="form-label">PO</label>
                                    <select class="form-select" id="po-{{ $costOverhead->id ?? 0 }}" name="po" required>
                                        <option value="CAPEX" {{ ($costOverhead->po ?? '') === 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX" {{ ($costOverhead->po ?? '') === 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expenses-{{ $costOverhead->id ?? 0 }}" class="form-label">Expense Head</label>
                                    <input type="text" class="form-control"
                                           id="expenses-{{ $costOverhead->id ?? 0 }}" name="expenses"
                                           value="{{ $costOverhead->expenses ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cost_per_month-{{ $costOverhead->id ?? 0 }}" class="form-label">
                                        Amount</label>
                                    <input type="number" class="form-control"
                                           id="cost_per_month-{{ $costOverhead->id ?? 0 }}" name="amount" step="any"
                                           value="{{ $costOverhead->amount ?? 0 }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Cost Overhead</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Financial Cost Update Modals -->
        @foreach ($financials ?? [] as $financialCost)
            <div class="modal fade" id="updateModal-{{ $financialCost->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateModalLabel-{{ $financialCost->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel-{{ $financialCost->id ?? 0 }}">Update Financial
                                Cost</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateFinancialCostForm-{{ $financialCost->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-financial-cost/' . ($financialCost->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type-{{ $financialCost->id ?? 0 }}" class="form-label">Type</label>
                                    <select class="form-select" id="type-{{ $financialCost->id ?? 0 }}" name="type" required>
                                        <option value="financial cost"
                                            {{ ($financialCost->type ?? '') === 'financial cost' ? 'selected' : '' }}>
                                            Financial Cost
                                        </option>
                                        <option value="Other"
                                            {{ ($financialCost->type ?? '') === 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="project-{{ $financialCost->id ?? 0 }}" class="form-label">Project</label>
                                    <select class="form-select" id="project-{{ $financialCost->id ?? 0 }}" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($financialCost->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="po-{{ $financialCost->id ?? 0 }}" class="form-label">PO</label>
                                    <select class="form-select" id="po-{{ $financialCost->id ?? 0 }}" name="po" required>
                                        <option value="CAPEX"
                                            {{ ($financialCost->po ?? '') === 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX"
                                            {{ ($financialCost->po ?? '') === 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expense-{{ $financialCost->id ?? 0 }}" class="form-label">Expense</label>
                                    <input type="text" class="form-control"
                                           id="expense-{{ $financialCost->id ?? 0 }}" name="expenses"
                                           value="{{ $financialCost->expenses ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="months-{{ $financialCost->id ?? 0 }}" class="form-label">Percentage</label>
                                    <input type="number" class="form-control" id="months-{{ $financialCost->id ?? 0 }}"
                                           name="amount" value="{{ $financialCost->percentage ?? 0 }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Financial Cost</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Capital Expenditure Update Modals -->
        @foreach ($capitalExpenditures ?? [] as $capital)
            <div class="modal fade" id="updateCapitalModal-{{ $capital->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="updateCapitalModalLabel-{{ $capital->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateCapitalModalLabel-{{ $capital->id ?? 0 }}">Update Capital
                                Expenditure</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateCapitalExpenseForm-{{ $capital->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-capital-expense/' . ($capital->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type-{{ $capital->id ?? 0 }}" class="form-label">Type</label>
                                    <select class="form-select" id="type-{{ $capital->id ?? 0 }}" name="type" required>
                                        <option value="Capital Expenditure"
                                            {{ ($capital->type ?? '') == 'Capital Expenditure' ? 'selected' : '' }}>
                                            Capital Expenditure
                                        </option>
                                        <option value="Other"
                                            {{ ($capital->type ?? '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="project-{{ $capital->id ?? 0 }}" class="form-label">Project</label>
                                    <select class="form-select" id="project-{{ $capital->id ?? 0 }}" name="project" required>
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($capital->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="po-{{ $capital->id ?? 0 }}" class="form-label">PO</label>
                                    <select class="form-select" id="po-{{ $capital->id ?? 0 }}" name="po" required>
                                        <option value="CAPEX" {{ ($capital->po ?? '') == 'CAPEX' ? 'selected' : '' }}>
                                            CAPEX
                                        </option>
                                        <option value="OPEX" {{ ($capital->po ?? '') == 'OPEX' ? 'selected' : '' }}>
                                            OPEX
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expense-{{ $capital->id ?? 0 }}" class="form-label">Expense</label>
                                    <input type="text" class="form-control" id="expense-{{ $capital->id ?? 0 }}"
                                           name="expenses" value="{{ $capital->expenses ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description-{{ $capital->id ?? 0 }}" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description-{{ $capital->id ?? 0 }}"
                                           name="description" value="{{ $capital->description ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status-{{ $capital->id ?? 0 }}" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status-{{ $capital->id ?? 0 }}"
                                           name="status" value="{{ $capital->status ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cost_per_month-{{ $capital->id ?? 0 }}" class="form-label">QUANTITY</label>
                                    <input type="number" class="form-control"
                                           id="cost_per_month-{{ $capital->id ?? 0 }}" name="total_number" step="any"
                                           value="{{ $capital->total_number ?? 0 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noOfPerson-{{ $capital->id ?? 0 }}" class="form-label">COST</label>
                                    <input type="number" class="form-control" id="noOfPerson-{{ $capital->id ?? 0 }}"
                                           name="cost" step="any" value="{{ $capital->cost ?? 0 }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update CAPEX</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Revenue Plan Update Modals -->
        @foreach ($revenuePlans ?? [] as $revenuePlan)
            <div class="modal fade" id="editRevenuePlan-{{ $revenuePlan->id ?? 0 }}" tabindex="-1"
                 aria-labelledby="editRevenuePlanLabel-{{ $revenuePlan->id ?? 0 }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editRevenuePlanLabel-{{ $revenuePlan->id ?? 0 }}">Edit Revenue
                                Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateRevenueForm-{{ $revenuePlan->id ?? 0 }}"
                                  action="{{ url('/pages/update-budget-project-revenue/' . ($revenuePlan->id ?? 0)) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type-{{ $revenuePlan->id ?? 0 }}" class="form-label">Type</label>
                                    <select class="form-select" id="type-{{ $revenuePlan->id ?? 0 }}" name="type" required>
                                        <option value="Revenue"
                                            {{ ($revenuePlan->type ?? '') == 'Revenue' ? 'selected' : '' }}>
                                            Revenue
                                        </option>
                                        <option value="Other"
                                            {{ ($revenuePlan->type ?? '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="project-{{ $revenuePlan->id ?? 0 }}" class="form-label">Project</label>
                                    <select class="form-select" id="project-{{ $revenuePlan->id ?? 0 }}" name="project">
                                        @foreach ($allProjects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ (($revenuePlan->project ?? '') == $project->id) ? 'selected' : '' }}>
                                                {{ $project->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount-{{ $revenuePlan->id ?? 0 }}" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount-{{ $revenuePlan->id ?? 0 }}"
                                           name="amount" value="{{ $revenuePlan->amount ?? 0 }}" required
                                           placeholder="Enter amount">
                                </div>
                                <div class="mb-3">
                                    <label for="description-{{ $revenuePlan->id ?? 0 }}" class="form-label">Description</label>
                                    <input type="text" class="form-control"
                                           id="description-{{ $revenuePlan->id ?? 0 }}" name="description"
                                           value="{{ $revenuePlan->description ?? '' }}" required
                                           placeholder="Enter description">
                                </div>
                                <input type="hidden" name="project_id" value="{{ $budget->id ?? 0 }}">

                                <button type="submit" class="btn btn-primary">Update Revenue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

</body>

</html>
@endsection
