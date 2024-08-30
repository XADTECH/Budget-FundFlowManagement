<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Phpass\PasswordHash;

class UserController extends Controller
{
  public function index()
  {
    return view('content.pages.pages-add-user-account');
  }

  // Store a newly created resource in storage
  public function store(Request $request)
  {
    //return response()->json($request->all());

    try {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'role' => 'required|string',
        'permissions' => 'nullable|array',
      ]);

      // Check if validation fails
      if ($validator->fails()) {
        $errors = $validator->errors();
        return back()
          ->withErrors($errors)
          ->withInput();
      }

      // Process image upload if an image is provided
      $fileName = '';
      if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = time() . rand(1, 99) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/profile'), $fileName);
      }

      $rounds = 12;
      // Hash the password using bcrypt
      $hashedpassword = Hash::make(trim($request->password), ['rounds' => $rounds]);
      // Create a new instance of the User model
      $user = new User();

      // Set the attributes
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->organization_unit = $request->organization_unit;
      $user->phone_number = $request->phone_number;
      $user->password = Hash::make(trim($request->password), ['rounds' => $rounds]);
      $user->role = $request->role;
      $user->permissions = $request->permissions ? json_encode($request->permissions) : null;
      $user->profile_image = $fileName;
      $user->nationality = $request->nationality;

      // Save the user to the database
      $user->save();
      return redirect()
        ->back()
        ->with('success', 'User created successfully');
    } catch (Exception $e) {
      return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    }
  }
}
