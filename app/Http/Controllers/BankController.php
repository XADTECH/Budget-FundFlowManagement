<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\LedgerEntry;
use App\Imports\BankImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Models\PlannedCash; // Ensure you import this model
use Exception; // Import the Exception class
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function addBankView(Request $request)
    {
        $banks = Bank::orderBy('created_at', 'DESC')->get();
        return view('content.pages.pages-show-add-bank-details', compact('banks'));
    }

    public function store(Request $request)
    {
        // return response($request->all());
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'iban' => 'required|string|max:34',
                'account' => 'required|string|max:20',
                'country' => 'required|string|max:20',
                'region' => 'required|string|max:20',
                'swift_code' => 'required|string|max:11',
                'address' => 'nullable|string|max:255',
                'branch' => 'required|string|max:255',
                'rm_detail' => 'nullable|string|max:255',
                'balance_amount' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Create a new bank record
            $bank = Bank::create([
                'bank_name' => $request->name,
                'iban' => $request->iban,
                'account' => $request->account,
                'country' => $request->country,
                'region' => $request->region,
                'swift_code' => $request->swift_code,
                'bank_address' => $request->address,
                'branch' => $request->branch,
                'rm_detail' => $request->rm_detail,
                'balance_amount' => $request->balance_amount ?? 0,
            ]);

            // Initial ledger entry
            LedgerEntry::create([
                'bank_id' => $bank->id,
                'amount' => $bank->balance_amount,
                'type' => 'credit', // Assuming initial balance is a credit
                'description' => 'Initial balance',
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Bank record added successfully!');
        } catch (\Exception $e) {
            // Redirect back with the error message
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    //get all bank records
    public function getRecords(Request $request)
    {
        $banks = Bank::all();
        return response()->json($banks);
    }

    public function updateRecord(Request $request)
    {
        // return response($request->all());
        try {
            // Find the bank record by ID
            $bank = Bank::findOrFail($request->input('bank_id'));
            $bank->bank_name = $request->name;
            $bank->account = $request->account;
            $bank->iban = $request->iban;
            $bank->bank_address = $request->address;
            $bank->swift_code = $request->swift_code;
            $bank->branch = $request->branch;
            $bank->rm_detail = $request->rm_detail;
            $bank->country = $request->country;
            $bank->region = $request->region;

            $bank->save();

            return redirect()->back()->with('success', 'Bank record updated Successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the bank record is not found
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()], 400);
        } catch (Exception $e) {
            // Handle any other exceptions
            return redirect()
                ->back()
                ->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function bankDetail(Request $request, $id)
    {
        $bank = Bank::where('id', $id)->first();

        return view('content.pages.pages-show-bank-details', compact('bank'));
    }

    //upload mass bank detail
    public function uploadBank(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // Use the BankImport class instead of PriceImport
            $import = new BankImport();

            // Perform the import operation
            Excel::import($import, $request->file('file'));

            // Get the number of failures from the import
            $failureCount = $import->failures()->count();
            Log::info('Import completed', ['failures' => $failureCount]);

            // If there are any import failures, log and show them
            if ($failureCount > 0) {
                $failures = $import->failures();
                Log::warning('Import had failures', ['failureCount' => $failureCount, 'firstFailure' => $failures->first()]);
                return redirect()->back()->withFailures($failures);
            }

            // Return success message if no failures
            return redirect()->back()->with('success', 'Data Imported Successfully');
        } catch (ValidationException $e) {
            // Handle validation errors during the import
            dd($e->errors());

            Log::error('Validation failed during import', [
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
                'failures' => $e->failures(),
            ]);
            return redirect()
                ->back()
                ->with('error', 'Validation Failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle general exceptions during the import
            dd($e->getMessage());
            Log::error('Import failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()
                ->back()
                ->with('error', 'Data Import Failed: ' . $e->getMessage());
        }
    }

    public function deleteRecord(Request $request)
    {
        try {
            // Validate that bank_id is provided
            $validator = Validator::make($request->all(), [
                'bank_id' => 'required|integer|exists:banks,id',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors(['errors' => $validator->errors()], 422);
            }

            // Find the bank record by ID
            $bank = Bank::find($request->input('bank_id'));

            if (!$bank) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Bank Record Not Found'], 400);
            }

            // Delete the bank record
            $bank->delete();

            return redirect()->back()->with('success', 'Bank record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'An Error Occured While Deleting the Bank Account !'], 500);
        }
    }

    public function showLedger($id)
    {
        $bank = Bank::where('id', $id)->first();
        $ledgerEntries = LedgerEntry::where('bank_id', $bank->id)->get(); // Retrieve all entries as a collection
        // return response($ledger);
        return view('content.pages.pages-show-bank-ledger', compact('bank', 'ledgerEntries'));
    }

    public function showLedgerByProject(Request $request)
    {
        $bank_id = $request->bank_id;
        $budget_project_id = $request->budget_project_id;

        // return response($request->all());

        // Retrieve the bank details
        $bank = Bank::find($bank_id);

        // Retrieve ledger entries for the specified bank and project
        $ledgerEntries = LedgerEntry::where('bank_id', $bank_id)->where('budget_project_id', $budget_project_id)->get();

        // Return the view with bank and ledger entries
        return view('content.pages.pages-show-bank-ledger', compact('bank', 'ledgerEntries'));
    }
}
