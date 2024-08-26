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
              <input  type="text" class="form-select" name="bank_detail" placeholder="Enter Details"/>
            </div>

            <div class="col-sm-6 mt-4">
              <input  type="text" class="form-select" name="bank_address" placeholder="Enter Address"/>
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
                <th>Balance</th>
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

<!--Model-->
<div class="modal fade" id="editBankModal" tabindex="-1" aria-labelledby="editBankModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBankModalLabel">Edit Bank Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editBankForm">
          <input type="hidden" id="bankId" name="bank_id">
          <div class="mb-3">
            <label for="bankName" class="form-label">Bank Name</label>
            <input type="text" class="form-control" id="bankName" name="bank_name">
          </div>
          <div class="mb-3">
            <label for="bankBalance" class="form-label">Bank Name</label>
            <input type="text" class="form-control" id="bankBalance" name="bankBalance">
          </div>
          <div class="mb-3">
            <label for="bankDetails" class="form-label">Bank Details</label>
            <input type="text" class="form-control" id="bankDetails" name="bank_details">
          </div>
          <div class="mb-3">
            <label for="bankAddress" class="form-label">Bank Address</label>
            <input type="text" class="form-control" id="bankAddress" name="bank_address">
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Utility function to display alerts
function showAlert(type, message) {
  const alertBox = document.getElementById('responseAlert');
  const alertMessage = document.getElementById('alertMessage');

  // Set the class name and message based on the type of alert
  if (type === 'success') {
    alertBox.className = 'alert alert-success alert-dismissible fade show';
  } else if (type === 'error') {
    alertBox.className = 'alert alert-danger alert-dismissible fade show';
  }

  alertMessage.textContent = message;
  alertBox.style.display = 'block';

  // Hide the alert after 3 seconds
  setTimeout(() => {
    alertBox.style.display = 'none';
  }, 3000);
}

// Format balance
function formatBalanceAmount(amount) {
  const num = parseFloat(amount); // Convert to a number
  const roundedAmount = Math.floor(num); // Remove decimals and round
  return roundedAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Format with commas
}

//delete bank record 
// Function to delete a bank record
function deleteRecord(bankId) {
  fetch('/api/delete-bank-record', { // Replace with your actual API endpoint
    method: 'POST',
    body: JSON.stringify({ bank_id: bankId }),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showAlert('success', data.success);
      fetchBankRecords(); // Refresh the bank records
    } else {
      showAlert('danger', data.error || 'An error occurred while deleting the bank record.');
    }
  })
  .catch(error => {
    console.error('Network error:', error);
    showAlert('danger', 'A network error occurred. Please try again.');
  });
}

// Function to attach event listeners to edit buttons
function attachEditButtonListeners() {
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function(e) {
      const bankId = this.getAttribute('data-id');
      const bankName = this.getAttribute('data-name');
      const bankDetails = this.getAttribute('data-details');
      const bankAddress = this.getAttribute('data-address');
      const bankBalance = this.getAttribute('data-balance');

      // Populate the modal fields
      document.getElementById('bankId').value = bankId;
      document.getElementById('bankName').value = bankName;
      document.getElementById('bankDetails').value = bankDetails ?? 'Not Entered';
      document.getElementById('bankAddress').value = bankAddress ?? 'Not Entered';
      document.getElementById('bankBalance').value = bankBalance;

      // Show the modal
      const modal = new bootstrap.Modal(document.getElementById('editBankModal'));
      modal.show();
    });
  });

    // Attach event listeners to delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
      const bankId = this.getAttribute('data-id');

      // Confirm deletion with the user
      if (confirm('Are you sure you want to delete this bank record?')) {
        deleteRecord(bankId);  // Call the function to delete the record
      }
    });
  });
}
  


// Fetch bank records and populate the table
function fetchBankRecords() {
  fetch('/api/get-bank-records') // Replace with your API endpoint
    .then(response => response.json())
    .then(data => {
      const tableBody = document.getElementById('bank-table-body');
      tableBody.innerHTML = ''; // Clear existing rows

      data.forEach(bank => {
        const row = document.createElement('tr');

        row.innerHTML = `
          <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">${bank.bank_name}</span></td>
          <td>${bank.bank_details ?? 'Not Entered'}</td>
          <td>${bank.bank_address ?? 'Not Entered'}</td>
          <td>${formatBalanceAmount(bank.balance_amount)}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item edit-btn" data-id="${bank.id}" data-name="${bank.bank_name}" data-balance="${formatBalanceAmount(bank.balance_amount)}" data-details="${bank.bank_details}" data-address="${bank.bank_address}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item delete-btn" data-id="${bank.id}" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        `;

        tableBody.appendChild(row);
      });

      // Re-attach event listeners to the new edit buttons
      attachEditButtonListeners();
    })
    .catch(error => {
      console.error('Error fetching bank records:', error);
      showAlert('error', 'Failed to fetch bank records.');
    });
}

// Submit post request for editing bank details
document.getElementById('editBankForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const modalElement = document.getElementById('editBankModal');
  const modal = bootstrap.Modal.getInstance(modalElement);
  const formData = new FormData(this);

  fetch('/api/update-bank-record', { // Replace with your actual API endpoint
    method: 'POST',
    body: formData,
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for security
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Bank details updated successfully:', data);
      modal.hide();
      fetchBankRecords(); // Refresh the bank records
      showAlert('success', 'Bank record updated successfully.');
    } else {
      console.error('Error updating bank details:', data.message);
      modal.hide();
      showAlert('error', data.message || 'Error updating bank details.');
    }
  })
  .catch(error => {
    console.error('Network error:', error);
    showAlert('error', 'Network error occurred.');
  });
});

// DOM content loaded
document.addEventListener('DOMContentLoaded', fetchBankRecords);

// Submit post request for adding bank records
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
    if (data.success) {
      fetchBankRecords();
      showAlert('success', data.success);
      this.reset();
    } else {
      showAlert('error', data.message || 'Error adding bank record.');
    }
  })
  .catch(error => {
    console.error('Network error:', error);
    showAlert('error', 'Network error occurred.');
  });
});
</script>



@endsection
