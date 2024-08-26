<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;

class BusinessUnitController extends Controller
{
  public function index()
  {
    return BusinessUnit::all();
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'source' => 'required|string',
      'unitdetail' => 'required|string',
      'unitremark' => 'nullable|string',
      'status' => 'required|string',
    ]);

    $businessUnit = BusinessUnit::create($validated);
    return response()->json($businessUnit, 201);
  }

  public function show(BusinessUnit $businessUnit)
  {
    return response()->json($businessUnit);
  }

  public function update(Request $request, BusinessUnit $businessUnit)
  {
    $validated = $request->validate([
      'source' => 'required|string',
      'unitdetail' => 'required|string',
      'unitremark' => 'nullable|string',
      'status' => 'required|string',
    ]);

    $businessUnit->update($validated);
    return response()->json($businessUnit);
  }

  public function destroy(BusinessUnit $businessUnit)
  {
    $businessUnit->delete();
    return response()->json(null, 204);
  }
}
