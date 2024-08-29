@extends('layouts/contentNavbarLayout')

@section('title', 'Project Budgeting - Pages')

@section('content')

<style>
    .limited-scroll {
        max-height: 200px;
        /* Set the maximum height as needed */
        overflow-y: auto;
        /* Adds a vertical scrollbar when content overflows */
        display: block;
        /* Ensures the scrollbar is visible on the tbody */
    }

    .font_style{
        font-weight:bold;
    }

    #error-alert, #success-alert {
    transition: opacity 0.5s ease-out;
    }

            /* Custom styles for scrollbar */
            .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #0067aa;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background-color: #004c7f;
        }

        .dropdown-header {
            cursor: pointer;
            font-size: 1.5rem; /* Change to adjust font size */
            color: #0067aa;
        }

        .dropdown-content {
            display: none; /* Hidden by default */
            margin-top: 15px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    
</style>
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Budget Management /</span> Edit Project Budget
</h4>

<div class="row">
    <div class="col-md-12">

        <!-- Alert box HTML -->
        <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none; width:80%; margin:10px auto">
            <span id="alertMessage"></span>
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>

                @if ($errors->any())
            <div class="alert alert-danger" id="error-alert">
                <!-- <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                    <!-- <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                {{ session('success') }}
            </div>
        @endif

        <!-- Project Form -->
        <div class="card">
            <div class="card-body">
                <h6>Add A Budget </h6>
                <form action="{{ route('add-project-budget') }}" method="POST">
                    @csrf
                <div class="row">
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Start Date</label>
                            <input type="date" id="startdate" class="form-control" name="startdate" placeholder="Enter Start Date" required />
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">End Date</label>
                            <input type="date" id="enddate" class="form-control" name="enddate" placeholder="Enter Start Date" />
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Date</label>
                            <input type="date" class="form-control" name="month" placeholder="Enter End Date" />
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Project Name</label>

                            <select class="form-select" name="projectname">
                            <option disabled selected value>Choose</option>
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Client </label>

                            <select class="form-select" name="client">
                            <option disabled selected value>Choose</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->clientname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Division </label>
                            <select class="form-select" name="division">
                            <option disabled selected value>Choose</option>
                            @foreach ($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->source}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <label for="startdate" class="form-label">Site Name </label>
                            <input type="text" class="form-control" name="sitename" placeholder="Please enter site name" />
                        </div>
                        <div class="col-sm-6">
                            <label for="region" class="form-label">Region </label>
                            <select class="form-select" name="region">
                            <option disabled selected value>Choose</option>
                                <option value="Abu Dhabi">Abu Dhabi</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Sharjah">Sharjah</option>
                                <option value="Umm Al Quwain">Umm Al Quwain</option>
                                <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                <option value="Fujairah">Fujairah</option>

                            </select>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label for="startdate" class="form-label">Project Manager / Client Manager </label>
                            <select class="form-select" name="manager">
                            <option disabled selected value>Choose</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 mt-4">
                            <label for="description" class="form-label"> Description </label>
                            <input type="text" class="form-control" name="description" placeholder="description"/>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Direct Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total Direct Cost - 1,0094,89 AED</h5>
                    <div class="mt-4">
                        <h3>Salary</h3>
                        <div class="table-responsive text-nowrap limited-scroll">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PO</th>
                                        <th>EXPENSES</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>Total Cost</th>
                                        <th>Resource Allocation</th>
                                        <th>Average Cost</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Type A</td>
                                        <td>Contract 001</td>
                                        <td>PO-123</td>
                                        <td>1000</td>
                                        <td>Active</td>
                                        <td>Lorem Ipsum</td>
                                        <td>5000</td>
                                        <td>25%</td>
                                        <td>500</td>
                                        <td>5500</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                    <h3>Facilities Cost</h3>
                    <div class="table-responsive text-nowrap limited-scroll">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>TYPE</th>
                                    <th>CONTRACT</th>
                                    <th>PO</th>
                                    <th>EXPENSES</th>
                                    <th>STATUS</th>
                                    <th>DESCRIPTION</th>
                                    <th>Total Cost</th>
                                    <th>Resource Allocation</th>
                                    <th>Average Cost</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Type A</td>
                                    <td>Contract 001</td>
                                    <td>PO-123</td>
                                    <td>1000</td>
                                    <td>Active</td>
                                    <td>Lorem Ipsum</td>
                                    <td>5000</td>
                                    <td>25%</td>
                                    <td>500</td>
                                    <td>5500</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="mt-4">
                    <h3>Material Cost</h3>
                    <div class="table-responsive text-nowrap limited-scroll">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>TYPE</th>
                                    <th>CONTRACT</th>
                                    <th>PO</th>
                                    <th>EXPENSES</th>
                                    <th>STATUS</th>
                                    <th>DESCRIPTION</th>
                                    <th>Total Cost</th>
                                    <th>Resource Allocation</th>
                                    <th>Average Cost</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Type A</td>
                                    <td>Contract 001</td>
                                    <td>PO-123</td>
                                    <td>1000</td>
                                    <td>Active</td>
                                    <td>Lorem Ipsum</td>
                                    <td>5000</td>
                                    <td>25%</td>
                                    <td>500</td>
                                    <td>5500</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <div class="dropdown-section">
                <h3 class="dropdown-header">Indirect Cost ▼</h3>
                <div class="dropdown-content">
                    <h5>Total Indirect Direct Cost - 1,0094,89 AED</h5>
                  
                    <div class="mt-4">
                    <h3>Cost Overhead</h3>
                    <div class="table-responsive text-nowrap limited-scroll">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>TYPE</th>
                                    <th>CONTRACT</th>
                                    <th>PO</th>
                                    <th>EXPENSES</th>
                                    <th>STATUS</th>
                                    <th>DESCRIPTION</th>
                                    <th>Total Cost</th>
                                    <th>Resource Allocation</th>
                                    <th>Average Cost</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Type A</td>
                                    <td>Contract 001</td>
                                    <td>PO-123</td>
                                    <td>1000</td>
                                    <td>Active</td>
                                    <td>Lorem Ipsum</td>
                                    <td>5000</td>
                                    <td>25%</td>
                                    <td>500</td>
                                    <td>5500</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                     </div>

                     <div class="mt-4">
                     <h3>Financial Cost</h3>
                        <div class="table-responsive text-nowrap limited-scroll">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PO</th>
                                        <th>EXPENSES</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>Total Cost</th>
                                        <th>Resource Allocation</th>
                                        <th>Average Cost</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Type A</td>
                                        <td>Contract 001</td>
                                        <td>PO-123</td>
                                        <td>1000</td>
                                        <td>Active</td>
                                        <td>Lorem Ipsum</td>
                                        <td>5000</td>
                                        <td>25%</td>
                                        <td>500</td>
                                        <td>5500</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                     </div>

                     <div class="mt-4">
                     <h3>Material Cost</h3>
                        <div class="table-responsive text-nowrap limited-scroll">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>TYPE</th>
                                        <th>CONTRACT</th>
                                        <th>PO</th>
                                        <th>EXPENSES</th>
                                        <th>STATUS</th>
                                        <th>DESCRIPTION</th>
                                        <th>Total Cost</th>
                                        <th>Resource Allocation</th>
                                        <th>Average Cost</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Type A</td>
                                        <td>Contract 001</td>
                                        <td>PO-123</td>
                                        <td>1000</td>
                                        <td>Active</td>
                                        <td>Lorem Ipsum</td>
                                        <td>5000</td>
                                        <td>25%</td>
                                        <td>500</td>
                                        <td>5500</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--Model-->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProjectForm">
                    <input type="hidden" id="projectId" name="project_id">
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="projectName" name="projectName" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectDetails" class="form-label">Project Details</label>
                        <input type="text" class="form-control" id="projectDetails" name="projectDetails">
                    </div>
                    <div class="mb-3">
                        <label for="projectRemarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="projectRemarks" name="projectRemarks">
                    </div>
                    <div class="mb-3">
                        <label for="projectStatus" class="form-label">Status</label>
                        <select class="form-select" id="projectStatus" name="projectStatus">
                            <option value="Active">Active</option>
                            <option value="Non Active">Non Active</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    function hideAlertAfterDelay(alertId, delay) {
        console.log('Trying to hide', alertId);
        var alertElement = document.getElementById(alertId);
        if (alertElement) {
            setTimeout(function() {
                console.log('Hiding', alertId);
                alertElement.style.opacity = 0; // Fade out effect
                setTimeout(function() {
                    alertElement.style.display = 'none'; // Hide element after fading out
                }, 500); // Match the duration of the fade-out effect
            }, delay);
        } else {
            console.log('Element not found:', alertId);
        }
    }

    // Hide alerts after 3000 ms
    hideAlertAfterDelay('error-alert', 3000);
    hideAlertAfterDelay('success-alert', 3000);
});

document.addEventListener('DOMContentLoaded', function () {
    const dropdownHeaders = document.querySelectorAll('.dropdown-header');

    dropdownHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const content = this.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        });
    });
});
</script>

@endsection