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

        @if (Auth::user()->role == 'Admin')

        @include('layouts.sections.menu.adminsidebar')
        @endif

        @if (Auth::user()->role == 'Project Manager')
        @include('layouts.sections.menu.pmosidebar')


        <!-- Purchase Order -->
        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Finance Manager')
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
        @endif


        <!-- payment Order -->
        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Finance Manager')
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
        @endif

        @if (Auth::user()->role == 'Project Manager')
        @include('layouts.sections.menu.pmosidebar')
        @endif

        @if (Auth::user()->role == 'Finance Manager' )
        @include('layouts.sections.menu.financesidebar')
        @endif

        @if (Auth::user()->role == 'Logistics' )
        @include('layouts.sections.menu.logisticssidebar')


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
                    <li class="menu-item {{ request()->routeIs('paymentOrders.list') ? 'active' : '' }}">
                        <a href="{{ route('paymentOrders.list') }}" class="menu-link">
                            <div>Payment Orders</div>
                        </a>
                    </li>
                </ul>
            </li>

        @endif

    </ul>

</aside>