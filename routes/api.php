
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannedCashController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

//cash flow management routes
Route::post('/add-opening-balance', [PlannedCashController::class, 'storeOpeningBalance']);
Route::get('/get-opening-balance', [PlannedCashController::class, 'getopeningBalance']);
Route::post('/add-cash-plan', [PlannedCashController::class, 'addcashplanAmount']);
Route::post('/add-cash-receive', [PlannedCashController::class, 'addcashreceiveAmount']);

//add bank record
Route::post('/add-bank-record', [BankController::class, 'addRecord'])->name('add-bank-record');
//get all bank records
Route::get('/get-bank-records', [BankController::class, 'getRecords'])->name('get-bank-records');
Route::post('/update-bank-record', [BankController::class, 'updateRecord'])->name('update-bank-record');
Route::post('/delete-bank-record', [BankController::class, 'deleteRecord'])->name('delete-bank-record');

//get all projects routes
Route::post('/add-project', [ProjectController::class, 'addRecord'])->name('add-project');
Route::get('/get-projects', [ProjectController::class, 'getRecords'])->name('get-projects');
Route::post('/update-project', [ProjectController::class, 'updateRecord'])->name('update-project');
Route::post('/delete-project', [ProjectController::class, 'deleteRecord'])->name('delete-project');
