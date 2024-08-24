@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')


<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Bank Management /</span> Add Bank Details
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
        <h6>Enter the Bank Name  </h6>
        <form id="openingBalanceForm">
          <div class="row">
            <div class="col-sm-6">
              <input  type="text" class="form-select" name="bank-name" placeholder="Enter Bank Name" required/>
            </div>
            <div class="col-sm-6">
              <input  type="text" class="form-select" name="bank-detail" placeholder="Enter Details" required/>
            </div>

            <div class="col-sm-6 mt-4">
              <input  type="text" class="form-select" name="bank-address" placeholder="Enter Address" required/>
            </div>

            <div class="col-sm-6 mt-4">
              <input  type="text" class="form-select" name="bank-balance" placeholder="opening balance ...." required/>
            </div>
       
            <div class="mt-4">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
            </div>
          </div>
         
        </form>
      </div>
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
            <tbody id="bank-table-body" class="table-border-bottom-0">
              <!-- Rows will be dynamically inserted here -->
          </tbody>
          </table>

      </div>
      <!-- /Notifications -->
    </div>
  </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', fetchBankRecords);

 
  document.getElementById('openingBalanceForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('/api/add-bank-record', {
      method: 'POST',
      body: formData,
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      const alertBox = document.getElementById('responseAlert');
      const alertMessage = document.getElementById('alertMessage');
      if (data.success) {
        console.log("there is data success");
        alertBox.className = 'alert alert-success alert-dismissible fade show';
        alertMessage.textContent = data.success; // Set the message content
        alertBox.style.display = 'block'; // Make the alert box visible
        this.reset();
        fetchOpeningBalance();
      } else {
        alertBox.className = 'alert alert-danger alert-dismissible fade show';
        alertMessage.textContent = data.message; // Set the error message content
        alertBox.style.display = 'block'; // Make the alert box visible
        this.reset();
      }

      // Show the alert
      alertBox.style.display = 'block';

      // Hide the alert after 5 seconds
      setTimeout(() => {
        alertBox.style.display = 'none';
      }, 3000);
    });
  });

  function fetchBankRecords() {
    fetch('/api/get-bank-records') // Replace with your API endpoint
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('bank-table-body');

            // Clear any existing rows
            tableBody.innerHTML = '';

            // Iterate over the data and create table rows
            data.forEach(bank => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">${bank.bank_name}</span></td>
                    <td>${bank.bank_details}</td>
                    <td>${bank.bank_address}</td>
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
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching bank records:', error);
        });
}

</script>

@endsection
