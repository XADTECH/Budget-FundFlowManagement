<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total In Direct Cost - {{$totalInDirectCost}}</h5>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Cost Overhead</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewCostOverheadModal">ADD NEW</button>
                        </div>
                        <p>Total overhead Cost : <span style="color:#0067aa; font-weight:bold">{{ number_format($totalCostOverhead, 0) }}<span></p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
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

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Financial Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewFinancialCostModal">ADD NEW</button>
                        </div>
                        <p>Total Financial Cost : <span style="color:#0067aa; font-weight:bold">{{ number_format($totalFinancialCost, 0) }}<span></p>
                        <div class="table-responsive text-nowrap limited-scroll mt-2">
                            <table class="table table-hover">
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cost Overhead Modal -->
<div class="modal fade" id="addNewCostOverheadModal" tabindex="-1" aria-labelledby="addNewCostOverheadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewCostOverheadModalLabel">Add New Cost Overhead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewCostOverheadForm" action="{{ url('/pages/add-budget-project-overhead-cost') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="overhead cost">Overhead Cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract" placeholder="e.g., contract number, annual maintenance" required>
                    </div>
                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select" id="project" name="project" required>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="po" class="form-label">PO</label>
                        <select class="form-select" id="po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX">OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense Head</label>
                        <input type="text" class="form-control" id="expense" name="expense" placeholder="e.g., overhead or other" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="cost_per_month" name="cost_per_month" placeholder="e.g., 150.00">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="e.g., Annual visa renewal cost or insurance coverage details">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="e.g., new, old, renew" required>
                    </div>
                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Person</label>
                        <input type="number" class="form-control" id="noOfPerson" name="noOfPerson" step="any" placeholder="e.g., 5" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any" placeholder="e.g., 12" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Cost Overhead</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Financial Cost Modal -->
<div class="modal fade" id="addNewFinancialCostModal" tabindex="-1" aria-labelledby="addNewFinancialCostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewFinancialCostModalLabel">Add New Financial Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewFinancialCostForm" action="{{ url('/pages/add-budget-project-financial-cost') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="financial cost">financial cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract" placeholder="e.g., Du Civil, Insurance" required>
                    </div>
                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select" id="project" name="project" required>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="po" class="form-label">PO</label>
                        <select class="form-select" id="po" name="po" required>
                            <option value="CAPEX">CAPEX</option>
                            <option value="OPEX">OPEX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expense" class="form-label">Expense</label>
                        <input type="text" class="form-control" id="expense" name="expense" placeholder="e.g., Risk, Finance cost" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost_per_month" class="form-label">Cost Per Month</label>
                        <input type="number" class="form-control" id="cost_per_month" name="cost_per_month" placeholder="e.g., 1000">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="e.g., 5% for Risk, 1% for Finance cost">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="e.g., new old or other" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any" placeholder="e.g., 12" required>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $budget->id }}">
                    <button type="submit" class="btn btn-primary">Add Financial Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>