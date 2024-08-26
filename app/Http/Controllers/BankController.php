<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\PlannedCash; // Ensure you import this model
use Exception; // Import the Exception class
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
  public function addBankView(Request $request)
  {
    return view('content.pages.pages-show-add-bank-details');
  }

  public function addRecord(Request $request)
  {
    //return response()->json($request->all());
    try {
      // Validate the request data
      $validatedData = $request->validate([
        'bank-name' => 'required|string|max:255',
        'bank-balance' => 'required|numeric|min:0',
        // Ensure to validate fields that will be used for PlannedCash if needed
      ]);

      // Assuming you want to create a Bank record instead of PlannedCash
      $bank = new Bank();
      $bank->bank_name = $validatedData['bank-name'];
      $bank->bank_details = $request->bank_detail;
      $bank->bank_address = $request->bank_address;
      $bank->balance_amount = $validatedData['bank-balance'];
      $bank->save();

      return response()->json(['success' => 'Bank details entered successfully']);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => $e->getMessage()], 500);
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
    try {
      // Create a Validator instance
      $validator = Validator::make($request->all(), [
        'bank_name' => 'nullable|string|max:255',
        'bankBalance' => 'nullable|string', // Consider validating as a number if this represents a balance
      ]);

      // Check if validation fails
      if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 422);
      }

      // Find the bank record by ID
      $bank = Bank::findOrFail($request->input('bank_id')); // Throws ModelNotFoundException if not found

      // Update the bank record with validated data
      $bank->update([
        'bank_name' => $request->input('bank_name', $bank->bank_name), // Use existing value if not provided
        'bank_details' => $request->input('bank_details', $bank->bank_details),
        'bank_address' => $request->input('bank_address', $bank->bank_address),
        'balance_amount' => str_replace(',', '', $request->input('bankBalance', $bank->balance_amount)), // Remove commas and use existing value if not provided
      ]);

      return response()->json(['success' => 'Bank record updated successfully.']);
    } catch (ModelNotFoundException $e) {
      // Handle the case where the bank record is not found
      return response()->json(['message' => 'Bank record not found.'], 404);
    } catch (Exception $e) {
      // Handle any other exceptions
      return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
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
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the bank record by ID
      $bank = Bank::find($request->input('bank_id'));

      if (!$bank) {
        return response()->json(['message' => 'Bank record not found.'], 404);
      }

      // Delete the bank record
      $bank->delete();

      return response()->json(['success' => 'Bank record deleted successfully.']);
    } catch (\Exception $e) {
      return response()->json(['error' => 'An error occurred while deleting the bank record.'], 500);
    }
  }
}
