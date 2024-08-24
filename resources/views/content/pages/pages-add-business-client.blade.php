@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')


<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Project Budgeting /</span> Add Business Client
</h4>

<div class="row">
  <div class="col-md-12">
    
    
      <!-- Alert box HTML -->
      <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none; width:80%; margin:10px auto">
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" aria-label="Close"></button>
      </div>


      <div class="card">
      <div class="card-body">
        <h6>Add A Client Name  </h6>
        <form id="ClientNameForm">
  <div class="row">
    <div class="col-sm-6">
      <input type="text" class="form-control" name="clientname" placeholder="Enter Client Name" required />
    </div>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="clientdetail" placeholder="Enter Client Detail" required />
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-sm-6">
      <input type="text" class="form-control" name="clientremark" placeholder="Remarks" required />
    </div>
    <div class="col-sm-6">
      <select class="form-select" name="status">
        <option value="Active">Active</option>
        <option value="Non Active">Not Active</option>
      </select>
    </div>
  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-primary me-2">Submit</button>
  </div>
</form>

      </div>

      <!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">List </h5>
  <div class="table-responsive text-nowrap">
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
      <tbody class="table-border-bottom-0">
  
        <tr>
          <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">DU</span></td>
          <td>Project Come Under Division Etisalat</td>
          <td>This is a new Project</td>
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">Etisalat</span></td>
          <td>Project Come Under Division Etisalat</td>
          <td>This is a new Project</td>
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
      
      </tbody>
    </table>
  </div>
</div>

      </div>

      <!-- /Notifications -->
    </div>
  </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', function() {
             fetchOpeningBalance();
        });



  function fetchOpeningBalance() 
  {
      
  }

</script>

@endsection
