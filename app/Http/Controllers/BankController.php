<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\PlannedCash; // Ensure you import this model
use Exception; // Import the Exception class

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
        'bank-detail' => 'required|string|max:500',
        'bank-address' => 'required|string|max:500',
        'bank-balance' => 'required|numeric|min:0',
        // Ensure to validate fields that will be used for PlannedCash if needed
      ]);

      // Assuming you want to create a Bank record instead of PlannedCash
      $bank = new Bank();
      $bank->bank_name = $validatedData['bank-name'];
      $bank->bank_details = $validatedData['bank-detail'];
      $bank->bank_address = $validatedData['bank-address'];
      $bank->balance_amount = $validatedData['bank-balance'];
      $bank->save();

      return response()->json(['success' => 'Bank details entered successfully']);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => $e->getMessage()], 500);
    }
  }

  public function getRecords(Request $request)
  {
    $banks = Bank::all();
    return response()->json($banks);
  }
}
