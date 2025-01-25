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

    .font_style {
        font-weight: bold;
    }

    #error-alert,
    #success-alert {
        transition: opacity 0.5s ease-out;
    }

    .dropdown-options select option:disabled {
        color: #6c63ff;
        font-weight: bold;
    }

    .custom-dropdown-list .dropdown-item:hover {
    background-color: #6c63ff;  /* Matching submit button color */
    color: #fff;
}

    .status-approved {
        color: #4caf50;
        /* Green for Approved */
    }

    .status-rejected {
        color: #ff6f6f;
        /* Red for Rejected */
    }

    .status-pending {
        color: #ff9800;
        /* Orange for Pending */
    }

    .status-default {
        color: #000000;
        /* Default color */
    }

    /* =========== Custom Dropdown Styles =========== */
    .dropdown-container {
        position: relative;
    }

    .dropdown-search {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .dropdown-options {
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        width: 100%;
        display: none;
        z-index: 1000;
    }

    .dropdown-options select {
        width: 100%;
        border: none;
        outline: none;
        padding: 8px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Budget Management /</span> Add Project Budget
</h4>

<div class="row">
    <div class="col-md-12">

        <!-- Alert box HTML -->
        <div id="responseAlert" class="alert alert-info alert-dismissible fade show" role="alert"
            style="display: none; width:80%; margin:10px auto">
            <span id="alertMessage"></span>
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success" id="success-alert">
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
                            <input type="date" id="startdate" class="form-control" name="startdate"
                                placeholder="Enter Start Date" required />
                        </div>
                        <div class="col-sm-4">
                            <label for="enddate" class="form-label">End Date</label>
                            <input type="date" id="enddate" class="form-control" name="enddate"
                                placeholder="Enter End Date" />
                        </div>
                        <div class="col-sm-4">
                            <label for="month" class="form-label">Choose Date</label>
                            <input type="date" class="form-control" name="month" placeholder="Enter Month" />
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Project Name (searchable dropdown) -->
                        <div class="col-sm-4 dropdown-container" id="projectname-container">
                            <label for="projectname-search" class="form-label">Choose Project Name</label>
                            <input type="text" id="projectname-search" class="form-control dropdown-search" placeholder="Search Project Name...">
                            <div class="dropdown-options">
                                <select id="projectname-select" class="form-select" name="projectname" size="5">
                                    <option disabled selected value>Choose</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Client (searchable dropdown) -->
                        <div class="col-sm-4 dropdown-container" id="client-container">
                            <label for="client-search" class="form-label">Choose Client</label>
                            <input type="text" id="client-search" class="form-control dropdown-search" placeholder="Search Client...">
                            <div class="dropdown-options">
                                <select id="client-select" class="form-select" name="client" size="5">
                                    <option disabled selected value>Choose</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->clientname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Division (searchable dropdown) -->
                        <div class="col-sm-4 dropdown-container" id="division-container">
                            <label for="division-search" class="form-label">Choose Division</label>
                            <input type="text" id="division-search" class="form-control dropdown-search" placeholder="Search Division...">
                            <div class="dropdown-options">
                                <select id="division-select" class="form-select" name="division" size="5">
                                    <option disabled selected value>Choose</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->source }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <label for="sitename" class="form-label">Site Name</label>
                            <input type="text" class="form-control" name="sitename" placeholder="Please enter site name" />
                        </div>

                        <!-- Country - Not modified (as requested) -->
                        <div class="col-sm-6">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country" name="country" onchange="updateRegions()">
                                <option disabled selected value>Choose</option>
                                <option value="KSA">KSA</option>
                                <option value="UAE">UAE</option>
                                <option value="UK">UK</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Region - Not modified (as requested) -->
                        <div class="col-sm-6">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" id="region" name="region">
                                <option disabled selected value>Choose</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="description" class="form-label"> Description </label>
                            <input type="text" class="form-control" name="description" placeholder="description" />
                        </div>

                        <div class="row mt-4">
                            <!-- Budget Type (searchable dropdown) -->
                            <div class="col-sm-4 dropdown-container" id="budgettype-container">
                                <label for="budgettype-search" class="form-label">Project Budget Type</label>
                                <input type="text" id="budgettype-search" class="form-control dropdown-search" placeholder="Search Budget Type...">
                                <div class="dropdown-options">
                                    <select id="budgettype-select" class="form-select" name="budget_type" size="5">
                                        <option disabled selected value>Choose</option>
                                        <option value="Fleet Management">Fleet Management</option>
                                        <option value="Auto Workshop">Auto Workshop</option>
                                        <option value="Etisalat Managed Service">Etisalat Managed Service</option>
                                        <option value="Fixed Network">Fixed Network</option>
                                        <option value="Mobile Network">Mobile Network</option>
                                        <option value="Operational Budget">Operational Budget</option>
                                        <option value="Incremental Budget">Incremental Budget</option>
                                        <option value="Capital Budget">Capital Budget</option>
                                        <option value="Project Budget">Project Budget</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="reference_id" class="form-label">Reference ID</label>
                                <input type="text" class="form-control" name="reference_id"
                                    placeholder="self reference ... AE-101H-DU-SO" />
                            </div>
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
    <div class="row mb-3 align-items-center">
        <div class="col-md-3 d-flex align-items-center">
            <h5 class="card-header mb-0">Budget List</h5>
        </div>
        <div class="col-md-9 text-end">
            <input type="text" id="tableSearch" class="form-control w-50 d-inline-block" placeholder="Search Project Budgets">
        </div>
    </div>

    
    
    <div class="table-responsive text-nowrap limited-scroll">
        <table class="table table-hover" id="sortableTable">
            <thead>
                <tr>
                    <th data-sort-type="string">
                        RefCode
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Month
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Country
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Project Name
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Project Manager
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Client
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Budget Type
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="number">
                        Budget Allocated
                        <i class="fa fa-sort"></i>
                    </th>
                    <th data-sort-type="string">
                        Status
                        <i class="fa fa-sort"></i>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="project-table-body">
                @foreach ($budgets as $budget)
                @php
                    $client = $clients->where('id', $budget->client_id)->first();
                    $clientName = $client ? $client->clientname : 'N/A';

                    $user = $users->where('id', $budget->manager_id)->first();
                    $userName = $user ? $user->email : 'N/A';

                    $project = $projects->firstWhere('id', $budget->project_id);
                    $projectName = $project ? $project->name : 'N/A';

                    $month = \Carbon\Carbon::parse($budget->month);
                    $formattedMonth = $month->format('F d, Y'); // e.g., August 15, 2024
                @endphp

                <tr>
        <td style="color:#0067aa">            <a href="{{ route('edit-project-budget', ['project_id' => $budget->id]) }}">{{ $budget->reference_code }}</a></td>
                    <td class="font_style">{{ $formattedMonth }}</td>
                    <td>{{ $budget->country }}</td>
                    <td class="font_style">{{ $projectName }}</td>
                    <td style="font-weight: bold;">
                        {{ $user->first_name ? ($userName . ' | ' . $user->first_name) : 'Admin' }}
                    </td>                    <td class="font_style">{{ $clientName }}</td>
                    <td class="font_style">{{ $budget->budget_type }}</td>
                    <td class="font_style" style="color: {{ is_null($budget->total_budget_allocated) ? '#ff6f6f' : '#4caf50' }};">
                        {{ $budget->total_budget_allocated ?? 'Not Allocated' }}
                    </td>
                    <td class="font_style" style="
                        color: @if ($budget->approval_status === 'approve') #4caf50;
                               @elseif($budget->approval_status === 'rejected') #ff6f6f;
                               @elseif($budget->approval_status === 'pending') #ff9800;
                               @else #000000; @endif
                    ">
                        {{ $budget->approval_status }}
                    </td>
                    <td>
                        <form action="{{ route('edit-project-budget', ['project_id' => $budget->id]) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bx bx-edit"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--Model-->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel"
    aria-hidden="true">
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

{{-- Scripts --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('sortableTable');
    const headers = table.querySelectorAll('thead th');

    headers.forEach((header, index) => {
        const sortType = header.dataset.sortType;
        if (!sortType) return; // Skip if no data-sort-type

        header.dataset.sortOrder = 'asc'; // Initial order

        header.addEventListener('click', function () {
            const currentOrder = header.dataset.sortOrder;
            const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
            header.dataset.sortOrder = newOrder;

            sortTableRows(table, index, sortType, newOrder);
            updateHeaderArrows(headers, header, newOrder);
        });
    });

    function sortTableRows(table, columnIndex, sortType, order) {
        const tbody = table.querySelector('tbody');
        const rowsArray = Array.from(tbody.querySelectorAll('tr'));

        rowsArray.sort((rowA, rowB) => {
            let cellA = rowA.children[columnIndex].innerText.trim();
            let cellB = rowB.children[columnIndex].innerText.trim();

            if (sortType === 'number') {
                cellA = parseFloat(cellA.replace(/[^0-9.-]+/g, '')) || 0;
                cellB = parseFloat(cellB.replace(/[^0-9.-]+/g, '')) || 0;
            } else {
                cellA = cellA.toLowerCase();
                cellB = cellB.toLowerCase();
            }

            if (cellA < cellB) return order === 'asc' ? -1 : 1;
            if (cellA > cellB) return order === 'asc' ? 1 : -1;
            return 0;
        });

        rowsArray.forEach(row => tbody.appendChild(row));
    }

    function updateHeaderArrows(allHeaders, activeHeader, order) {
        allHeaders.forEach(hdr => {
            const icon = hdr.querySelector('i.fa');
            if (icon) {
                icon.classList.remove('fa-arrow-up', 'fa-arrow-down', 'fa-sort');
                icon.classList.add('fa-sort');
            }
        });

        const activeIcon = activeHeader.querySelector('i.fa');
        if (activeIcon) {
            activeIcon.classList.remove('fa-sort');
            if (order === 'asc') {
                activeIcon.classList.add('fa-arrow-up');
            } else {
                activeIcon.classList.add('fa-arrow-down');
            }
        }
    }
});


    // Hide alerts after 3000 ms
    document.addEventListener('DOMContentLoaded', function() {
        function hideAlertAfterDelay(alertId, delay) {
            var alertElement = document.getElementById(alertId);
            if (alertElement) {
                setTimeout(function() {
                    alertElement.style.opacity = 0; // Fade out effect
                    setTimeout(function() {
                        alertElement.style.display = 'none'; // Hide element after fading out
                    }, 500); 
                }, delay);
            }
        }
        hideAlertAfterDelay('error-alert', 3000);
        hideAlertAfterDelay('success-alert', 3000);
    });

    // Keep your existing country/region logic intact (unchanged)
    function updateRegions() {
        const country = document.getElementById("country").value;
        const regionSelect = document.getElementById("region");
        regionSelect.innerHTML = '<option disabled selected value>Choose</option>'; // Reset regions

        const regions = {
            'KSA': ['Riyadh', 'Jeddah', 'Dammam', 'Makkah', 'Madinah'],
            'UAE': ['Abu Dhabi', 'Dubai', 'Sharjah', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah'],
            'UK': ['London', 'Manchester', 'Birmingham', 'Glasgow', 'Edinburgh'],
            'USA': ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Miami']
        };

        if (regions[country]) {
            regions[country].forEach(region => {
                const option = document.createElement("option");
                option.value = region;
                option.text = region;
                regionSelect.appendChild(option);
            });
        }
    }

    // Table search logic (unchanged)
    document.getElementById('tableSearch').addEventListener('keyup', function () {
        var searchValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#project-table-body tr');
        rows.forEach(function (row) {
            var found = false;
            row.querySelectorAll('td').forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchValue)) {
                    found = true;
                }
            });
            row.style.display = found ? '' : 'none';
        });
    });

    /***************************************************
     *  Generic function to set up search & dropdown behavior 
     *  for any container with an <input> and <select>.
     ***************************************************/
    function setupDropdown(searchInputId, selectId, containerId) {
        const searchInput = document.getElementById(searchInputId);
        const dropdown = document.getElementById(selectId);
        const container = document.querySelector(containerId);
        const dropdownOptions = container.querySelector('.dropdown-options');

        // Filter options based on user input
        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();
            let found = false;

            for (let i = 0; i < dropdown.options.length; i++) {
                const option = dropdown.options[i];
                if (option.text.toLowerCase().includes(searchText)) {
                    option.style.display = 'block';
                    found = true;
                } else {
                    option.style.display = 'none';
                }
            }
            dropdownOptions.style.display = found ? 'block' : 'none';
        });

        // When user selects an option, update the text input
        dropdown.addEventListener('change', function() {
            searchInput.value = dropdown.options[dropdown.selectedIndex].text;
            dropdownOptions.style.display = 'none';
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest(containerId)) {
                dropdownOptions.style.display = 'none';
            }
        });

        // Show dropdown when focusing the text input
        searchInput.addEventListener('focus', function() {
            dropdownOptions.style.display = 'block';
        });
    }

    /***************************************************
     *  Initialize each custom dropdown on page load
     ***************************************************/
    document.addEventListener('DOMContentLoaded', function() {
        // Project Name
        setupDropdown('projectname-search', 'projectname-select', '#projectname-container');

        // Client
        setupDropdown('client-search', 'client-select', '#client-container');

        // Division
        setupDropdown('division-search', 'division-select', '#division-container');

        // Budget Type
        setupDropdown('budgettype-search', 'budgettype-select', '#budgettype-container');
    });
</script>

@endsection
