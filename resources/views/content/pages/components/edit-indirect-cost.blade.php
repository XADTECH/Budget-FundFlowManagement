
<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total Indirect Direct Cost - 1,0094,89 AED</h5>
                  
                    <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                            <h3>Cost Overhead</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewCostOverheadModal">ADD NEW</button>
                        </div>
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
                                <tr>
                                    <td>1</td>
                                    <td>Cost</td>
                                    <td>Contract 001</td>
                                    <td>Project Alpha</td>
                                    <td>CAPEX</td>
                                    <td>2000</td>
                                    <td>Salary for team</td>
                                    <td>1000 AED</td>
                                    <td>5</td>
                                    <td>12</td>
                                    <td>5000 AED</td>
                                    <td>60000 AED</td>
                                    <td>Active</td>
                                </tr>    
                                </tbody>
                            </table>
                        </div>
                     </div>

                     <div class="mt-4">
                     <div class="d-flex justify-content-between align-items-center">
                            <h3>Financial Cost</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewFinancialCostModal">ADD NEW</button>
                            </div>
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
                                <tr>
                                    <td>1</td>
                                    <td>Cost</td>
                                    <td>Contract 001</td>
                                    <td>Project Alpha</td>
                                    <td>CAPEX</td>
                                    <td>2000</td>
                                    <td>Salary for team</td>
                                    <td>1000 AED</td>
                                    <td>5</td>
                                    <td>12</td>
                                    <td>5000 AED</td>
                                    <td>60000 AED</td>
                                    <td>Active</td>
                                </tr>    
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
                <form id="addNewCostOverheadForm">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Cost">Cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract" required>
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
                        <input type="text" class="form-control" id="expense" name="expense" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Person</label>
                        <input type="number" class="form-control" id="noOfPerson" name="noOfPerson" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any" required>
                    </div>
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
                <form id="addNewFinancialCostForm">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Cost">Cost</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contract" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="contract" name="contract" required>
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
                        <input type="text" class="form-control" id="expense" name="expense" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <div class="mb-3">
                        <label for="noOfPerson" class="form-label">No Of Person</label>
                        <input type="number" class="form-control" id="noOfPerson" name="noOfPerson" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="months" class="form-label">Months</label>
                        <input type="number" class="form-control" id="months" name="months" step="any" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Financial Cost</button>
                </form>
            </div>
        </div>
    </div>
</div>
