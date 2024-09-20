<style>
    /* Modal Height */
    .modal-dialog {
        max-height: 550px; /* Set maximum height for the modal */
        height:550px;
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
        scrollbar-width: thin; /* For Firefox */
        scrollbar-color: #0067aa #e0e0e0; /* For Firefox */
    }

    .modal-body::-webkit-scrollbar {
        width: 8px; /* Width of the scrollbar */
    }

    .modal-body::-webkit-scrollbar-thumb {
        background-color: #0067aa; /* Color of the scrollbar thumb */
        border-radius: 4px; /* Optional: Rounded corners for the scrollbar thumb */
    }

    .modal-body::-webkit-scrollbar-track {
        background-color: #e0e0e0; /* Color of the scrollbar track */
    }
</style>
            <div class="container mt-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="dropdown-section">
                            <h3 class="dropdown-header">CAPEX || Total Cost ▼</h3>
                            <div class="dropdown-content">
                                <!-- Salary Section -->
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                    <h5>Total CAPEX  :  {{number_format($totalCapitalExpenditure)}} AED</h5>
                                    @php
                                        $totalOPEX = $totalDirectCost + $totalInDirectCost + $totalNetProfitBeforeTax;
                                    @endphp
                                    <h5>Total OPEX: {{ number_format($totalOPEX) }} AED</h5>
                                    <h5>Total OPEX + CAPEX  :  {{number_format($totalOPEX + $totalCapitalExpenditure)}} AED</h5>
                                    </div>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewCapitalExpense">ADD CAPEX</button>
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

                                            @foreach($budget->capitalExpenditures as $capitalExpense)
                                                    <tr>
                                                        <td>{{$capitalExpense->sn}}</td>
                                                        <td>{{$capitalExpense->type}}</td>
                                                        <td>{{$capitalExpense->contract}}</td>
                                                        <td>{{$capitalExpense->project}}</td>
                                                        <td>{{$capitalExpense->po}}</td>
                                                        <td>{{$capitalExpense->expenses}}</td>
                                                        <td>{{$capitalExpense->description}}</td>
                                                        <td>{{$capitalExpense->cost_per_month}}</td>
                                                        <td>{{$capitalExpense->no_of_staff}}</td>
                                                        <td>{{$capitalExpense->no_of_months}}</td>
                                                        <td>{{$capitalExpense->average_cost}}</td>
                                                        <td>{{$capitalExpense->total_cost}}</td>
                                                        <td>{{$capitalExpense->status}}</td>
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

      <!-- Capital Expenditure Modal -->
        <div class="modal fade" id="addNewCapitalExpense" tabindex="-1" aria-labelledby="addNewSalaryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewSalaryModalLabel">Add New Capital Expenditure</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addNewCapitalExpenseForm" action="{{ url('/pages/add-budget-capital-expense') }}" method="POST">
                        @csrf
          
                  
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
                            <label for="expense" class="form-label">Equipment</label>
                            <select class="form-control" id="expense" name="expense" required>
                                <option value="">Select a Equipment</option>
                                <option value="Cable Detector">Cable Detector</option>
                                <option value="Plate Compactor">Plate Compactor</option>
                                <option value="Generator 5 kva"> Generator 5 kva</option>
                                <option value="Jack Hammer">Jack Hammer</option>
                                <option value="Cable Pulling Rod 200m"> Cable Pulling Rod 200m</option>
                                <option value="Cable Pulling Rod 300m"> Cable Pulling Rod 300m</option>
                                <option value="Cable Pulling Rod 500m 16mm">Cable Pulling Rod 500m 16mm</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_number" class="form-label">Total No</label>
                            <input type="number" class="form-control" id="total_number" name="total_number" placeholder="e.g., 1,2,3" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="e.g., 5.1 Cable Detector" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="e.g., new, old" required>
                        </div>
             
                    
                        <input type="hidden" name="project_id" value="{{ $budget->id }}">
                        <button type="submit" class="btn btn-primary">Add CAPEX</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



<script>



</script>