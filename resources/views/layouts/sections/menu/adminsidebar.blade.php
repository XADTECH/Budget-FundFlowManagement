  <!-- Budget Management -->
  <li class="menu-item {{ request()->is('pages/add-project-*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-rocket"></i>
          <div>Budget Management</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/add-project-budget') ? 'active' : '' }}">
              <a href="/pages/add-project-budget" class="menu-link">
                  <div>Add Project Budget</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('pages/add-project-name') ? 'active' : '' }}">
              <a href="/pages/add-project-name" class="menu-link">
                  <div>Add Project Name</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('pages/add-business-unit') ? 'active' : '' }}">
              <a href="/pages/add-business-unit" class="menu-link">
                  <div>Add Business Unit</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('pages/add-business-client') ? 'active' : '' }}">
              <a href="/pages/add-business-client" class="menu-link">
                  <div>Add Client</div>
              </a>
          </li>
      </ul>
  </li>

  {{-- <!-- Cash Flow Management -->
        @if (Auth::user()->role == 'Finance Manager' || Auth::user()->role == 'Admin')
            <li class="menu-item {{ request()->is('pages/add-opening-balance') || request()->is('pages/allocate-cash') || request()->is('pages/cash-receive-amount') || request()->is('pages/plan-cash-report') ? 'active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-money"></i>
      <div>Cash Flow Management</div>
  </a>
  <ul class="menu-sub">
      <li class="menu-item {{ request()->is('pages/add-opening-balance') ? 'active' : '' }}">
          <a href="/pages/add-opening-balance" class="menu-link">
              <div>Add Opening Balance</div>
          </a>
      </li>
      <li class="menu-item {{ request()->is('pages/allocate-cash') ? 'active' : '' }}">
          <a href="/pages/allocate-cash" class="menu-link">
              <div>Allocate Cash</div>
          </a>
      </li>
      <li class="menu-item {{ request()->is('pages/cash-receive-amount') ? 'active' : '' }}">
          <a href="/pages/cash-receive-amount" class="menu-link">
              <div>Add Cash Receive</div>
          </a>
      </li>
      <li class="menu-item {{ request()->is('pages/plan-cash-report') ? 'active' : '' }}">
          <a href="/pages/plan-cash-report" class="menu-link">
              <div>Report</div>
          </a>
      </li>
  </ul>
  </li>
  @endif --}}

  <li
      class="menu-item {{ request()->is('pages/cashflow/create') || request()->is('pages/allocate-cash') || request()->is('pages/cash-receive-amount') || request()->is('pages/plan-cash-report') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div>Fund Management</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/cashflow/create') ? 'active' : '' }}">
              <a href="/pages/cashflow/create" class="menu-link">
                  <div>Inflow / OutFlow</div>
              </a>
          </li>
      </ul>
  </li>

  <!-- Purchase Order -->
  <li class="menu-item {{ request()->is('pages/add-budget-project-purchase-order') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div>Purchase Order</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ request()->is('pages/add-budget-project-purchase-order') ? 'active' : '' }}">
              <a href="/pages/add-budget-project-purchase-order" class="menu-link">
                  <div>Add Purchase Order</div>
              </a>
          </li>
      </ul>
  </li>


  <!-- payment Order -->
  <li class="menu-item {{ request()->is('pages/payment-orders/create') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dollar"></i>
          <div>Payment Order</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/payment-orders/create') ? 'active' : '' }}">
              <a href="/pages/payment-orders/create" class="menu-link">
                  <div>Add Payment Order</div>
              </a>
          </li>
      </ul>
  </li>

  <!-- Bank Management -->
  <li class="menu-item {{ request()->is('pages/add-bank-detail') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
          <div>Bank Management</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/add-bank-detail') ? 'active' : '' }}">
              <a href="/pages/add-bank-detail" class="menu-link">
                  <div>Add Bank</div>
              </a>
          </li>
      </ul>
  </li>

  <!-- User Management -->
  <li
      class="menu-item {{ request()->is('pages/users') || request()->is('pages/add-user') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div>User Management</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/users') ? 'active' : '' }}">
              <a href="/pages/users" class="menu-link">
                  <div>Users List</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('pages/add-user') ? 'active' : '' }}">
              <a href="/pages/add-user" class="menu-link">
                  <div>Add User</div>
              </a>
          </li>
      </ul>
  </li>

  <!-- Report -->
  <li
      class="menu-item {{ request()->is('pages/budget-lists') || request()->is('pages/cash-flow-list') || request()->routeIs('show-allocated-budgets') || request()->is('filter-purchase-orders') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-pen"></i>
          <div>Report</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->is('pages/budget-lists') ? 'active' : '' }}">
              <a href="/pages/budget-lists" class="menu-link">
                  <div>Budget Report</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('pages/cash-flow-list') ? 'active' : '' }}">
              <a href="/pages/cash-flow-list" class="menu-link">
                  <div>Cash Flow Report</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('filter-purchase-orders') ? 'active' : '' }}">
              <a href="/filter-purchase-orders" class="menu-link">
                  <div>PO Report</div>
              </a>
          </li>
          <li class="menu-item {{ request()->routeIs('show-allocated-budgets') ? 'active' : '' }}">
              <a href="{{ route('show-allocated-budgets') }}" class="menu-link">
                  <div>Track Budget</div>
              </a>
          </li>
          <li class="menu-item {{ request()->routeIs('paymentOrders.list') ? 'active' : '' }}">
              <a href="{{ route('paymentOrders.list') }}" class="menu-link">
                  <div>Payment Orders</div>
              </a>
          </li>
      </ul>
  </li>