<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
  public function showaddProjectView(Request $request)
  {
    return view('content.pages.pages-add-project-name');
  }

  public function addRecord(Request $request)
  {
    //return response()->json($request->all());
    try {
      // Validate the request data
      $validatedData = $request->validate([
        'projectname' => 'required|string|max:255',
        'status' => 'required|string|in:Active,Non Active',
      ]);

      // Create a new Project record
      $project = new Project();
      $project->name = $validatedData['projectname'];
      $project->projectdetail = $request->projectdetail;
      $project->projectremark = $request->projectremark;
      $project->status = $validatedData['status'];
      $project->save();

      return response()->json(['success' => 'Project added successfully']);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }

  public function getRecords(Request $request)
  {
    try {
      $projects = Project::all();
      return response()->json($projects);
    } catch (Exception $e) {
      // Log the exception message if needed
      \Log::error($e->getMessage());

      return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }

  public function updateRecord(Request $request)
  {
    //return response()->json($request->all());
    try {
      // Create a Validator instance
      $validator = Validator::make($request->all(), [
        'project_id' => 'required|integer|exists:projects,id',
      ]);

      // Check if validation fails
      if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 422);
      }

      // Find the project record by ID
      $project = Project::findOrFail($request->input('project_id'));

      // Update the project record with validated data
      $project->update([
        'name' => $request->input('projectName', $project->name),
        'projectdetail' => $request->input('projectDetails', $project->projectdetail),
        'projectremark' => $request->input('projectRemarks', $project->projectremark),
        'status' => $request->input('projectStatus', $project->status),
      ]);

      return response()->json(['success' => 'Project updated successfully']);
    } catch (Exception $e) {
      // Handle exceptions
      return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
    }
  }

  public function deleteRecord(Request $request)
  {
    try {
      // Validate that project_id is provided
      $validator = Validator::make($request->all(), [
        'project_id' => 'required|integer|exists:projects,id',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the project record by ID
      $project = Project::find($request->input('project_id'));

      if (!$project) {
        return response()->json(['message' => 'Project record not found.'], 404);
      }

      // Delete the project record
      $project->delete();

      return response()->json(['success' => 'Project deleted successfully']);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
    }
  }

  public function showaddBusinessUnit()
  {
    return view('content.pages.pages-add-business-unit');
  }

  public function showaddBusinessClient()
  {
    return view('content.pages.pages-add-business-client');
  }
}
