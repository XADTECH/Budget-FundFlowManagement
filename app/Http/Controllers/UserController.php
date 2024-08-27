<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
  public function index()
  {
    return view('content.pages.pages-add-user-account');
  }

  // Store a newly created resource in storage
  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'confirm_password' => 'required|string',
        'role' => 'required|string',
        'permissions' => 'nullable|array',
      ]);

      if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 422);
      }

      // Check if passwords match
      if ($request->password !== $request->confirm_password) {
        return response()->json(['message' => ['confirm_password' => ['Passwords do not match.']]], 400);
      }

      // Process image upload if an image is provided
      $fileName = '';
      if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = time() . rand(1, 99) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/profile'), $fileName);
      }

      // Create the new user
      $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'organization_unit' => $request->organization_unit,
        'phone_number' => $request->phone_number,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'permissions' => $request->permissions ? json_encode($request->permissions) : null,
        'profile_image' => $fileName, // Save the image path to the database
        'nationality' => $request->nationality,
      ]);

      return response()->json(['message' => ['user created' => ['user created successfully.']]], 200);
    } catch (Exception $e) {
      return response()->json(['message' => ['Error' => $e->getMessage()]], 200);
    }
  }
}
