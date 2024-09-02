<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\PlannedCashController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DirectCostController;
use App\Http\Controllers\InDirectCostController;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

// Main Page Route
// Public route for the login page with middleware to redirect if authenticated
Route::get('/', [LoginBasic::class, 'index'])
  ->name('auth-login-basic')
  ->middleware('redirectIfAuthenticated');

Route::post('/login-user', [AuthenticateController::class, 'loginUser'])->name('login-user');

//check all routes
Route::middleware(['checklogin'])->group(function () {
  Route::get('/checkhash', [AuthenticateController::class, 'checkHash'])->name('checkhash');
  Route::post('/logout', [AuthenticateController::class, 'LogoutUser'])->name('logout');

  // Protected routes with custom checklogin middleware

  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

  // layout
  Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
  Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
  Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
  Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
  Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

  // pages
  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
    'pages-account-settings-account'
  );
  Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
    'pages-account-settings-notifications'
  );
  Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
    'pages-account-settings-connections'
  );
  Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
  Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
    'pages-misc-under-maintenance'
  );

  //cash flow management pages
  Route::get('/pages/add-opening-balance', [PlannedCashController::class, 'addBalance'])->name('add-opening-balance');
  Route::get('/pages/add-bank-detail', [BankController::class, 'addBankView'])->name('add-opening-balance');
  Route::get('/pages/allocate-cash', [PlannedCashController::class, 'allocateCash'])->name('allocate-cash');
  Route::get('/pages/cash-receive-amount', [PlannedCashController::class, 'cashreceiveAmount'])->name(
    'cash-receive-amount'
  );
  Route::get('/pages/plan-cash-report', [PlannedCashController::class, 'plancashReport'])->name('plan-cash-report');

  //project management
  Route::get('/pages/add-project-name', [ProjectController::class, 'showaddProjectView'])->name('add-project-name');
  Route::get('/pages/add-business-unit', [ProjectController::class, 'showaddBusinessUnit'])->name('add-business-unit');
  Route::get('/pages/add-business-client', [ProjectController::class, 'showaddBusinessClient'])->name(
    'add-business-client'
  );

  // Budget Managment
  Route::get('/pages/add-project-budget', [BudgetController::class, 'index'])->name('add-project-budget');
  Route::post('/pages/add-project-budget', [BudgetController::class, 'store'])->name('add-project-budget');
  Route::get('/pages/edit-project-budget/{project_id}', [BudgetController::class, 'edit'])->name('edit-project-budget');

  // authentication
  //Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

  //direct cost controller

  //salary
  Route::post('/pages/add-budget-project-salary', [DirectCostController::class, 'storeSalary'])->name(
    'add-budget-project-salary'
  );

  //facility cost
  Route::post('/pages/add-budget-project-facility-cost', [DirectCostController::class, 'storeFacility'])->name(
    'add-budget-project-salary'
  );

  //material cost
  Route::post('/pages/add-budget-project-material-cost', [DirectCostController::class, 'storeMaterial'])->name(
    'add-budget-project-salary'
  );

  //Cost Overhead Cost
  Route::post('/pages/add-budget-project-overhead-cost', [InDirectCostController::class, 'storeCostOverhead'])->name(
    'add-budget-project-overhead-cost'
  );

  //add Financial Cost
  Route::post('/pages/add-budget-project-financial-cost', [InDirectCostController::class, 'storeFinancialCost'])->name(
    'add-budget-project-financial-cost'
  );

    //add Revenue
    Route::post('/pages/add-budget-project-revenue', [BudgetController::class, 'storeRevenue'])->name(
      'add-budget-project-revenue'
    );

  // cards
  Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

  // User Interface
  Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
  Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
  Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
  Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
  Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
  Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
  Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
  Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
  Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
  Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
  Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
  Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
  Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
  Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
  Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
  Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
  Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
  Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
  Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

  // extended ui
  Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name(
    'extended-ui-perfect-scrollbar'
  );
  Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

  // icons
  Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

  // form elements
  Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
  Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

  // form layouts
  Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
  Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

  // tables
  Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

  //user management
  Route::get('/pages/add-user', [UserController::class, 'index'])->name('add-user');

  // Add other routes that require authentication here

  //add user

  //user management
  Route::post('add-user', [UserController::class, 'store'])->name('add-user');
  Route::get('pages/users', [UserController::class, 'usersList'])->name('user-lists');
});

//check indivisual route
// Route::get('/dashboard', [DashboardController::class, 'index'])
//   ->middleware('checkLogin')
//   ->name('dashboard');
