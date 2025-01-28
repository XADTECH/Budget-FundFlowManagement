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

    /* Styles for the searchable dropdown */
    .dropdown-container {
        position: relative;
        margin-bottom: 1rem;
    }

    .dropdown-options {
        position: absolute;
        width: 100%;
        background-color: white;
        border: 1px solid #ced4da;
        border-top: none;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
        display: none; /* Hidden by default */
    }

    .dropdown-options select {
        width: 100%;
        border: none;
        outline: none;
        padding: 0.375rem 0.75rem;
        cursor: pointer;
    }

    .dropdown-search {
        width: 100%;
        box-sizing: border-box;
    }

    /* Optional: Style scrollbar for better appearance */
    .dropdown-options select::-webkit-scrollbar {
        width: 8px;
    }

    .dropdown-options select::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
</style>

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Report /</span> Filter Report
</h4>
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<!-- Projects Table -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">PROJECT BUDGET LIST</h5>
        <div class="d-flex">
            <form class="d-flex" method="GET" action="{{ route('budgets.list') }}">
                <input type="text" name="reference_code" class="form-control me-2" placeholder="Please enter Budget Reference Code" aria-label="Search" value="{{ request('reference_code') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <form class="container" method="GET" action="{{ route('budgets.list') }}">
        <div class="row mb-4">
            <!-- Searchable Projects Dropdown -->
            <div class="col-md-4 dropdown-container">
                <label for="project_search" class="form-label">Projects</label>
                <!-- Text input for filtering project list -->
                <input
                    type="text"
                    id="project_search"
                    class="form-control dropdown-search"
                    placeholder="Search for project..."
                    autocomplete="off"
                    value="{{ isset($fields['project_name']) ? $fields['project_name'] : '' }}"
                />

                <!-- Hidden input to hold the selected project_id (needed for form submission) -->
                <input
                    type="hidden"
                    id="project_id_hidden"
                    name="project_id"
                    value="{{ $fields['project_id'] ?? '' }}"
                />

                <!-- The dropdown to show filtered projects -->
                <div class="dropdown-options">
                    <select id="project_name" class="form-select" size="5">
                        <option disabled selected value>Choose</option>
                        @foreach ($projects as $project)
                            <option
                                value="{{ $project->id }}"
                                {{ isset($fields['project_id']) && $fields['project_id'] == $project->id ? 'selected' : '' }}
                            >
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Searchable Clients Dropdown -->
            <div class="col-md-4 dropdown-container">
                <label for="client_search" class="form-label">Choose Client</label>
                <!-- Text input for filtering client list -->
                <input
                    type="text"
                    id="client_search"
                    class="form-control dropdown-search"
                    placeholder="Search for client..."
                    autocomplete="off"
                    value="{{ isset($fields['client_name']) ? $fields['client_name'] : '' }}"
                />

                <!-- Hidden input to hold the selected client_id (needed for form submission) -->
                <input
                    type="hidden"
                    id="client_id_hidden"
                    name="client_id"
                    value="{{ $fields['client_id'] ?? '' }}"
                />

                <!-- The dropdown to show filtered clients -->
                <div class="dropdown-options">
                    <select id="client_name" class="form-select" size="5">
                        <option disabled selected value>Choose</option>
                        @foreach ($clients as $client)
                            <option
                                value="{{ $client->id }}"
                                {{ isset($fields['client_id']) && $fields['client_id'] == $client->id ? 'selected' : '' }}
                            >
                                {{ $client->clientname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Searchable Project Managers Dropdown -->
            <div class="col-md-4 dropdown-container">
                <label for="manager_search" class="form-label">Project Manager / Client Manager</label>
                <!-- Text input for filtering manager list -->
                <input
                    type="text"
                    id="manager_search"
                    class="form-control dropdown-search"
                    placeholder="Search for manager..."
                    autocomplete="off"
                    value="{{ isset($fields['manager_name']) ? $fields['manager_name'] : '' }}"
                />

                <!-- Hidden input to hold the selected manager_id (needed for form submission) -->
                <input
                    type="hidden"
                    id="manager_id_hidden"
                    name="manager_id"
                    value="{{ $fields['manager_id'] ?? '' }}"
                />

                <!-- The dropdown to show filtered managers -->
                <div class="dropdown-options">
                    <select id="manager_name" class="form-select" size="5">
                        <option disabled selected value>Choose</option>
                        @foreach ($users as $user)
                            <option
                                value="{{ $user->id }}"
                                {{ isset($fields['manager_id']) && $fields['manager_id'] == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Status Select -->
            <div class="col-md-4">
                <label for="approval_status" class="form-label">Status</label>
                <select class="form-select" name="approval_status" id="approval_status">
                    <option disabled selected value>Choose Status</option>
                    <option {{ isset($fields['approval_status']) && $fields['approval_status'] === "Approve" ? 'selected' : '' }} value="Approve">Approve</option>
                    <option {{ isset($fields['approval_status']) && $fields['approval_status'] === "Pending" ? 'selected' : '' }} value="Pending">Pending</option>
                    <option {{ isset($fields['approval_status']) && $fields['approval_status'] === "Cancelled" ? 'selected' : '' }} value="Cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Start Date Input -->
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>

            <!-- End Date Input -->
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
        </div>
        <div class="row" style="margin-bottom:20px">
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('budgets.list') }}" class="btn btn-secondary">Clear Filter</a>
            </div>
        </div>
    </form>
</div>

<div class="card mt-4">
    <div class="table-responsive text-nowrap limited-scroll">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>RefCode</th>
                    <th>Month</th>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Project Manager</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Budget Allocate</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="project-table-body" class="table-border-bottom-0">
                @foreach($budgets as $budget)

                    @php
                        // Find the client name from the $clients collection
                        $client = $clients->firstWhere('id', $budget->client_id);
                        $clientName = $client ? $client->clientname : 'N/A'; // Handle cases where client is not found

                        $user = $users->firstWhere('id', $budget->manager_id);
                        $userName = $user ? $user->first_name . ' ' . $user->last_name : 'ADMIN'; // Handle cases where user is not found

                        $project = $projects->firstWhere('id', $budget->project_id);
                        $projectName = $project ? $project->name : 'N/A'; // Handle cases where project is not found

                        $unit = $units->firstWhere('id', $budget->unit_id);
                        $unitName = $unit ? $unit->source : 'N/A'; // Handle cases where unit is not found

                        // Parse the month using Carbon
                        $month = \Carbon\Carbon::parse($budget->month);

                        // Format month and year
                        $formattedMonth = $month->format('F'); // Full month name (e.g., August)
                        $formattedYear = $month->format('Y'); // Year (e.g., 2024)
                    @endphp

                    <tr>
                        <td style="color:#0067aa">{{ $budget->reference_code }}</td>
                        <td class="font_style">{{ $formattedMonth }} {{ $formattedYear }}</td>
                        <td class="font_style">{{ $projectName }}</td>
                        <td class="font_style">{{ $clientName }}</td>
                        <td class="font_style">{{ $userName }}</td>
                        <td class="font_style">{{ $budget->start_date }}</td>
                        <td class="font_style">{{ $budget->end_date }}</td>
                        <td class="font_style">
                            @if (is_null($budget->total_budget_allocated) || $budget->total_budget_allocated <= 0)
                                <span style="color: red;">Budget Not Allocated</span>
                            @else
                                {{ number_format($budget->total_budget_allocated, 2) }}
                            @endif
                        </td>
                        <td class="font_style">
                            @if (in_array(strtolower($budget->approval_status), ['approved', 'approve']))
                                <span class="badge bg-success">{{ $budget->approval_status }}</span>
                            @elseif(in_array(strtolower($budget->approval_status), ['cancelled', 'cancel', 'rejected', 'reject']))
                                <span class="badge bg-danger">{{ $budget->approval_status }}</span>
                            @else
                                <span class="badge bg-warning">{{ $budget->approval_status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('budget-project-report-summary', ['id' => $budget->id]) }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-file" style="color:white"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div style="margin-bottom:50px"></div>

<!-- JavaScript for Searchable Dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all searchable dropdowns
        const dropdowns = [
            {
                searchInputId: 'project_search',
                dropdownId: 'project_name',
                hiddenInputId: 'project_id_hidden'
            },
            {
                searchInputId: 'client_search',
                dropdownId: 'client_name',
                hiddenInputId: 'client_id_hidden'
            },
            {
                searchInputId: 'manager_search',
                dropdownId: 'manager_name',
                hiddenInputId: 'manager_id_hidden'
            }
        ];

        dropdowns.forEach(function(dropdownConfig) {
            const searchInput = document.getElementById(dropdownConfig.searchInputId);
            const dropdown = document.getElementById(dropdownConfig.dropdownId);
            const dropdownContainer = searchInput.parentElement.querySelector('.dropdown-options');
            const hiddenInput = document.getElementById(dropdownConfig.hiddenInputId);

            // Function to filter and set selected value
            function matchInput() {
                const searchText = searchInput.value.toLowerCase().trim();
                let foundExact = false;
                let visibleCount = 0;

                // Loop over each <option> in the dropdown
                for (let i = 0; i < dropdown.options.length; i++) {
                    const option = dropdown.options[i];
                    const optionText = option.text.toLowerCase();

                    // Show the option if it includes the search text
                    if (optionText.includes(searchText)) {
                        option.style.display = 'block';
                        visibleCount++;

                        // If an exact match to the typed text, store the ID
                        if (optionText === searchText) {
                            hiddenInput.value = option.value;
                            foundExact = true;
                        }
                    } else {
                        option.style.display = 'none';
                    }
                }

                // Show or hide the dropdown based on visible options
                if (visibleCount > 0) {
                    dropdownContainer.style.display = 'block';
                } else {
                    dropdownContainer.style.display = 'none';
                }

                // Optional: Uncomment the following lines if you want to clear the hidden input when no exact match is found
                // if (!foundExact) {
                //     hiddenInput.value = '';
                // }
            }

            // Event listeners for input events
            searchInput.addEventListener('input', matchInput);
            searchInput.addEventListener('paste', function() {
                setTimeout(matchInput, 100);
            });

            // Handle selection from dropdown
            dropdown.addEventListener('change', function() {
                const selectedIndex = dropdown.selectedIndex;
                if (selectedIndex > 0) { // Ignore the 'Choose' option
                    hiddenInput.value = dropdown.options[selectedIndex].value;
                    searchInput.value = dropdown.options[selectedIndex].text;
                } else {
                    hiddenInput.value = '';
                    searchInput.value = '';
                }
                dropdownContainer.style.display = 'none';
            });

            // Optional: Update hidden input when an option is clicked
            dropdown.addEventListener('click', function() {
                hiddenInput.value = dropdown.value;
            });

            // Hide the dropdown if user clicks anywhere outside the dropdown-container
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown-container')) {
                    dropdownContainer.style.display = 'none';
                }
            });

            // Show the dropdown when search input is focused (optional)
            searchInput.addEventListener('focus', function() {
                if (dropdown.options.length > 1) { // If there are options besides 'Choose'
                    dropdownContainer.style.display = 'block';
                }
            });

            // Initialize the search input and hidden field if a selection is already made
            (function initializeSelection() {
                const selectedOption = dropdown.querySelector('option[selected][value]');
                if (selectedOption && selectedOption.value) {
                    hiddenInput.value = selectedOption.value;
                    searchInput.value = selectedOption.text;
                }
            })();
        });

        // Validate form before submission to ensure valid selections
        document.querySelector('form').addEventListener('submit', function(event) {
            const requiredDropdowns = [
                { hiddenInputId: 'project_id_hidden', searchInputId: 'project_search', label: 'Project' },
                { hiddenInputId: 'client_id_hidden', searchInputId: 'client_search', label: 'Client' },
                { hiddenInputId: 'manager_id_hidden', searchInputId: 'manager_search', label: 'Project Manager' }
            ];

            for (let i = 0; i < requiredDropdowns.length; i++) {
                const { hiddenInputId, searchInputId, label } = requiredDropdowns[i];
                const hiddenInput = document.getElementById(hiddenInputId);
                const searchInput = document.getElementById(searchInputId);

                // If the field is not required, you can skip the validation
                // For this example, we'll assume all are optional
                // Uncomment the following lines if you want to make them required
                /*
                if (!hiddenInput.value) {
                    event.preventDefault();
                    alert(`Please select a valid ${label}.`);
                    searchInput.focus();
                    return;
                }
                */
            }
        });
    });
</script>

@endsection
