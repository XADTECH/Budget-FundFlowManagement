<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessClient;
use Illuminate\Support\Facades\Validator;

class BusinessClientController extends Controller
{
  // Show the view for adding a Business Client
  public function showaddBusinessClient(Request $request)
  {
    return view('content.pages.pages-add-business-client');
  }

  // Add a new Business Client record
  public function addRecord(Request $request)
  {
    try {
      // Validate the request data
      $validatedData = $request->validate([
        'clientname' => 'required|string|max:255',
      ]);

      // Create a new BusinessClient record
      $businessClient = new BusinessClient();
      $businessClient->clientname = $validatedData['clientname'];
      $businessClient->clientdetail = $request->clientdetail;
      $businessClient->clientremark = $request->clientremark;
      $businessClient->status = $request->status;
      $businessClient->save();

      return response()->json(['success' => 'client added successfully']);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }

  // Retrieve all Business Client records
  public function getRecords(Request $request)
  {
    try {
      $businessClients = BusinessClient::all();
      return response()->json($businessClients);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }

  // Update an existing Business Client record
  public function updateRecord(Request $request)
  {
    try {
      // Validate the request data
      $validator = Validator::make($request->all(), [
        'client_id' => 'required|integer|exists:business_clients,id',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the Business Client record by ID
      $businessClient = BusinessClient::findOrFail($request->input('client_id'));

      // Update the Business Client record with validated data
      $businessClient->update([
        'clientname' => $request->input('clientname', $businessClient->clientname),
        'clientdetail' => $request->input('clientdetail', $businessClient->clientdetail),
        'clientremark' => $request->input('clientremark', $businessClient->clientremark),
        'status' => $request->input('status', $businessClient->status),
      ]);

      return response()->json(['success' => 'Business client updated successfully']);
    } catch (Exception $e) {
      // Handle exceptions
      return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
    }
  }

  // Delete a Business Client record
  public function deleteRecord(Request $request)
  {
    //return response()->json($request->all());
    try {
      // Validate that client_id is provided
      $validator = Validator::make($request->all(), [
        'client_id' => 'required|integer|exists:business_clients,id', // Corrected table name here
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the Business Client record by ID
      $businessClient = BusinessClient::find($request->input('client_id'));

      if (!$businessClient) {
        return response()->json(['message' => 'Business client record not found.'], 404);
      }

      // Delete the Business Client record
      $businessClient->delete();

      return response()->json(['success' => 'Business client deleted successfully']);
    } catch (Exception $e) {
      return response()->json(['message' => 'An error occurred while deleting the business client record.'], 500);
    }
  }
}
