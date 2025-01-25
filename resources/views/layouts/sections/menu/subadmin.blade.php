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