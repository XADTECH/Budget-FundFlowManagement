<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessUnitController extends Controller
{
  public function index()
  {
    return BusinessUnit::all();
  }

  public function store(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'source' => 'required|string',
        'status' => 'required|string',
      ]);

      $businessUnit = new BusinessUnit();
      $businessUnit->source = $validatedData['source'];
      $businessUnit->unitdetail = $request->unitdetail;
      $businessUnit->unitremark = $request->unitremark;
      $businessUnit->status = $validatedData['status'];
      $businessUnit->save();

      return response()->json(['success' => 'Business unit added successfully'], 200);
    } catch (Exception $e) {
      return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
    }
  }

  public function show(BusinessUnit $businessUnit)
  {
    return response()->json($businessUnit);
  }

  public function update(Request $request)
  {
    try {
      // Create a Validator instance
      $validator = Validator::make($request->all(), [
        'business_unit_id' => 'required|integer|exists:business_units,id',
        'source' => 'required|string',
        'unitdetail' => 'required|string',
        'unitremark' => 'nullable|string',
        'status' => 'required|string',
      ]);

      // Check if validation fails
      if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 422);
      }

      // Find the business unit record by ID
      $businessUnit = BusinessUnit::findOrFail($request->input('business_unit_id'));

      // Update the business unit record with values from the request
      $businessUnit->update([
        'source' => $request->input('source'),
        'unitdetail' => $request->input('unitdetail'),
        'unitremark' => $request->input('unitremark', $businessUnit->unitremark),
        'status' => $request->input('status'),
      ]);

      return response()->json(['success' => 'Business unit updated successfully']);
    } catch (Exception $e) {
      // Handle exceptions
      return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
    }
  }

  // Delete a business unit
  public function destroy(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'business_unit_id' => 'required|integer|exists:business_units,id',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Retrieve validated data
      $validatedData = $validator->validated();

      // Find the business unit record by ID
      $businessUnit = BusinessUnit::find($validatedData['business_unit_id']);

      if (!$businessUnit) {
        return response()->json(['message' => 'Business unit not found.'], 404);
      }

      // Delete the business unit record
      $businessUnit->delete();

      return response()->json(['success' => 'Business unit deleted successfully'], 200);
    } catch (Exception $e) {
      return response()->json(['message' => 'An error occurred while deleting the business unit.'], 500);
    }
  }
}
