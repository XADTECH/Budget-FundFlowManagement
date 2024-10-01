<?php

namespace App\Http\Controllers;

use App\Imports\PriceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierPriceController extends Controller
{
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    try {
        Excel::import(new PriceImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data Imported Successfully');
    } catch (\Exception $e) {
        \Log::error('Import failed', ['message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Data Import Failed');
    }
}


    public function showImport(Request $request)
    {
        return view('content.pages.pages-import-suppliers');
    }
}
