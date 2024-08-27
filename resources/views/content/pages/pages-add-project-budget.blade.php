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
</style>
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Budget Management /</span> Add Project Budget
</h4>

<div class="row">
    <div class="col-md-12">

        <!-- Alert box HTML -->
        <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none; width:80%; margin:10px auto">
            <span id="alertMessage"></span>
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>

        <!-- Project Form -->
        <div class="card">
            <div class="card-body">
                <h6>Add A Budget </h6>
                <form id="projectForm">
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
                            <input type="date" class="form-control" name="choosedate" placeholder="Enter End Date" />
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Project Name</label>

                            <select class="form-select" name="projectname">
                                <option value="">Choose</option>
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Client </label>

                            <select class="form-select" name="client">
                                <option value="Active">Choose</option>
                                @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->clientname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="startdate" class="form-label">Choose Division </label>
                            <select class="form-select" name="division">
                                <option value="Active">Out Source</option>
                                <option value="Non Active">Non OutSource</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <label for="startdate" class="form-label">Site Name </label>
                            <input type="text" class="form-control" name="sitename" placeholder="Please enter site name" />
                        </div>
                        <div class="col-sm-6">
                            <label for="startdate" class="form-label">Region </label>
                            <input type="text" class="form-control" name="region" placeholder="Please enter region" />
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label for="startdate" class="form-label">Project Manager / Client Manager </label>
                            <select class="form-select" name="manager">
                                <option value="Active">Choose</option>
                                <option value="Non Active">Asad</option>
                            </select>
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

<!-- Projects Table -->
<div class="card mt-4">
    <h5 class="card-header">List</h5>
    <div class="table-responsive text-nowrap  limited-scroll">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="project-table-body" class="table-border-bottom-0">
                <!-- Project rows will be added here -->
            </tbody>
        </table>
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

</script>

@endsection