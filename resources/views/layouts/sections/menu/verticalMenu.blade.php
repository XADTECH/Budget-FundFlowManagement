<style>
    .menu-subheading {
        font-size: 0.8em;
        font-weight: bold;
        color: #4CAF50;
        /* Change color as needed */
        margin: 10px 0;
        padding: 5px 15px;
        border-bottom: 1px solid #ddd;
        /* Add a bottom border for separation */
    }

    .menu-subheading span {
        display: block;
        text-transform: uppercase;
        /* Optional: Make text uppercase */
    }
</style>


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
            <img src="{{ asset('assets/img/xad/xad.jfif') }}" alt="XAD Image" style="height:80px">
            <span class="app-brand-text menu-text fw-bold ms-2">XAD Technology</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps ps--active-y">

        <!--Budget Management-->
        <li class="menu-item active open">
            <a href="http://localhost:8000" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-rocket"></i>
                <div>Budget Management</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="/pages/add-project-budget" class="menu-link">
                        <div>Add Project Budget</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="/pages/add-project-name" class="menu-link">
                        <div>Add Project Name</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="/pages/add-business-unit" class="menu-link">
                        <div>Add Business Unit</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>


                <li class="menu-item">
                    <a href="/pages/add-business-client" class="menu-link">
                        <div>Add Client</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>

            </ul>
        </li>

           <!--Purchase Order-->
           <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-ball"></i>
                <div>Manage Purchase Order</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                <a href="/pages/add-budget-project-purchase-order" class="menu-link">
                        <div>Add Purchase Order</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>
            </ul>
        </li>


        <!--cash flow Management-->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div> Cash Flow Management</div>
            </a>
            <ul class="menu-sub">

                <a href="javascript:void(0);" class="menu-link">
                    <div style="color:Green; font-weight:bold;text-decoration:underline;">Planned Cash</div>
                </a>

                <li class="menu-item">
                    <a href="/pages/add-opening-balance" class="menu-link">
                        <div>Add Opening Balance</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/pages/allocate-cash" class="menu-link">
                        <div>Allocate Cash</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/pages/cash-receive-amount" class="menu-link">
                        <div>Add Cash Receive</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/pages/plan-cash-report" class="menu-link">
                        <div>Report</div>
                    </a>
                </li>
            </ul>
        </li>

        <!--Bank Management-->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                <div>Bank Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pages/add-bank-detail" class="menu-link">
                        <div>Add Bank</div>
                    </a>
                </li>
            </ul>
        </li>


        <!--User Management -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>User Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pages/users" class="menu-link">
                        <div>Users List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/pages/add-user" class="menu-link">
                        <div>Add User</div>
                    </a>
                </li>

            </ul>
        </li>

        <!--Report -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div>Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pages/budget-lists" class="menu-link">
                        <div>Budget Report</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pages/budget-lists" class="menu-link">
                        <div>PO Report</div>
                    </a>
                </li>
            </ul>
        </li>

             <!--Finance -->
        <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div>Finance</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                <a href="" class="menu-link">
                        <div>Purchase Orders</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                    <a href="" class="menu-link">
                        <div>Budget Reports</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>
            </ul>
        </li> -->


    </ul>

      

</aside>