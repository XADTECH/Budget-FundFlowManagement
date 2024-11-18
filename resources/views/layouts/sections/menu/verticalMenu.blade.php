<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/xad/xad.jfif') }}" alt="XAD Image" style="height:80px">
            <span class="app-brand-text menu-text fw-bold ms-2">XAD Technology</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps ps--active-y">

        <!-- Budget Management -->
        @if (Auth::user()->role == 'Project Manager' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Finance Manager')
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
        @endif

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

        @if (Auth::user()->role == 'Finance Manager' || Auth::user()->role == 'Admin')
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
        @endif


        <!-- Purchase Order -->
        @if (Auth::user()->role == 'Admin' ||  Auth::user()->role == 'Finance Manager')
            <li class="menu-item {{ request()->is('pages/add-budget-project-purchase-order') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-ball"></i>
                    <div>Manage Purchases</div>
                </a>
                <ul class="menu-sub">
                    <li
                        class="menu-item {{ request()->is('pages/add-budget-project-purchase-order') ? 'active' : '' }}">
                        <a href="/pages/add-budget-project-purchase-order" class="menu-link">
                            <div>Add Purchase Order</div>
                        </a>
                    </li>
                    <li
                    class="menu-item {{ request()->is('pages/add-budget-project-payment-order') ? 'active' : '' }}">
                    <a href="/pages/add-budget-project-payment-order" class="menu-link">
                        <div>Add Payment Order</div>
                    </a>
                </li>
                </ul>
            </li>
        @endif

        <!-- Bank Management -->
        @if (Auth::user()->role == 'Finance Manager' || Auth::user()->role == 'Admin')
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
        @endif

        <!-- User Management -->
        @if (Auth::user()->role == 'Admin')
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
        @endif

        <!-- Report -->
        @if (Auth::user()->role == 'Finance Manager' || Auth::user()->role == 'Admin')
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
                </ul>
            </li>
        @endif

    </ul>

</aside>
