<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function showaddProjectView(Request $request)
  {
    return view('content.pages.pages-add-project-name');
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
