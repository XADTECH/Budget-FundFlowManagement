@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User Management /</span> Add User 
</h4>

<style>
  .alert {
    opacity: 1;
    transition: opacity 0.6s ease-out;
    background-color:#696cff;
    color:white;
    text-align:center;
}
</style>

<div class="row">
  <div class="col-md-12">
     <!-- Alert box HTML -->
     <div id="alert-container"></div>

    <!-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> -->
    <div class="card mb-4">
      <h5 class="card-header">User Details</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="profile_image"/>
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input class="form-control" type="text" id="first_name" name="first_name" value="" placeholder="John" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="last_name" id="last_name" value="" placeholder="Doe"/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="" placeholder="john.doe@example.com" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="organization_unit" class="form-label">organization_unit Unit</label>
              <input type="text" class="form-control" id="organization_unit" name="organization_unit"  placeholder="Finance / Admin"  value="" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phone_number">Phone Number</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">UAE (+971)</span>
                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="050 123 567" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" name="password" class="form-control" placeholder="202 555 0111" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm password" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
            </div>
            <div class="mb-3 col-md-6">
            <label for="address" class="form-label">Role</label>
            <select name="role" class="form-control" required>
                @foreach(App\Models\User::roles() as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="nationality" class="form-label">Nationality</label>
              <input type="text" class="form-control" id="nationality" name="nationality" placeholder="pakistan" maxlength="6" />
            </div>
            <!-- <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Country</label>
              <select id="country" class="select2 form-select">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="language" class="form-label">Language</label>
              <select id="language" class="select2 form-select">
                <option value="">Select Language</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="timeZones" class="form-label">Timezone</label>
              <select id="timeZones" class="select2 form-select">
                <option value="">Select Timezone</option>
                <option value="-12">(GMT-12:00) International Date Line West</option>
                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                <option value="-10">(GMT-10:00) Hawaii</option>
                <option value="-9">(GMT-09:00) Alaska</option>
                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                <option value="-7">(GMT-07:00) Arizona</option>
                <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Central America</option>
                <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                <option value="-6">(GMT-06:00) Saskatchewan</option>
                <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                <option value="-5">(GMT-05:00) Indiana (East)</option>
                <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="-4">(GMT-04:00) Caracas, La Paz</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="select2 form-select">
                <option value="">Select Currency</option>
                <option value="usd">USD</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="bitcoin">Bitcoin</option>
              </select>
            </div> -->
          </div>
          <div class="form-group">
            <label class="form-label">Permissions</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="Project Management" id="permission-project-management">
                <label class="form-check-label" for="permission-project-management">Project Management</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="Cash Flow Management" id="permission-cash-flow-management">
                <label class="form-check-label" for="permission-cash-flow-management">Cash Flow Management</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="Bank Management" id="permission-bank-management">
                <label class="form-check-label" for="permission-bank-management">Bank Management</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="User Management" id="permission-user-management">
                <label class="form-check-label" for="permission-user-management">User Management</label>
            </div>
        </div>

          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <!-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> -->
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <!-- <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-medium mb-1">Are you sure you want to delete your account?</h6>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div> -->
  </div>
</div>

<script>

  // Utility function to display alerts
  function showAlert(type, message) {
    // Create an alert container if it doesn't exist
    let alertContainer = document.getElementById('alert-container');
    if (!alertContainer) {
        alertContainer = document.createElement('div');
        alertContainer.id = 'alert-container';
        document.body.appendChild(alertContainer);
    }

    // Create a new alert element
    const alertElement = document.createElement('div');
    alertElement.className = `alert alert-${type} fade show`; // Added 'fade show' for Bootstrap alerts
    alertElement.innerText = message;

    // Append the alert to the container
    alertContainer.appendChild(alertElement);

    // Automatically remove the alert after 5 seconds
    setTimeout(() => {
        alertElement.classList.remove('show'); // Hide with Bootstrap's fade effect
        alertElement.classList.add('fade'); // Optional: Fade effect
        setTimeout(() => alertElement.remove(), 500); // Remove from DOM after fade out
    }, 3000); // Display for 5 seconds
}

    //form submission
    const form = document.getElementById('formAccountSettings');

    form.addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(form);
    try {
        const response = await fetch('/api/add-user', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for security
            }
        });

        const data = await response.json();

        if (response.ok) {
            if (typeof data === 'object' && data.message) {
                const errors = data.message;
                for (const field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errors[field].forEach(errorMessage => {
                            showAlert('error', errorMessage);
                        });
                    }
                }
            } else {
                showAlert('success', data.message || 'User created successfully.');
            }
        } else {
            showAlert('error', data.message || 'Error creating user.');
        }
    } catch (error) {
        console.error('Network error:', error);
        showAlert('error', 'Network error occurred.');
    } finally {
        // Reset the form after showing alerts
        form.reset();

    }
});

</script>
@endsection
