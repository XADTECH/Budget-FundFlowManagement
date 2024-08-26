@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')


<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Project Budgeting /</span> Add Business Unit
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
          <h6>Add A Business Unit Name  </h6>
          <form id="businessunitForm">
          <div class="row">
          <div class="col-sm-6">
            <select class="form-select" name="source">
              <option value="OutSource">OutSource</option>
              <option value="NotOutSource">Not Outsource</option>
            </select>
          </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="unitdetail" placeholder="Enter a Unit Detail" required />
              </div>
          </div>

          <div class="row mt-4">
            <div class="col-sm-6">
              <input type="text" class="form-control" name="unitremark" placeholder="Remarks" required />
            </div>
            <div class="col-sm-6">
              <select class="form-control" name="status">
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
