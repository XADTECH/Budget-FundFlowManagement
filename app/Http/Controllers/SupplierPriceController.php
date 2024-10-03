<?php

namespace App\Http\Controllers;

use App\Imports\PriceImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class SupplierPriceController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $import = new PriceImport();
            Excel::import($import, $request->file('file'));

            $failureCount = $import->failures()->count();
            Log::info('Import completed', ['failures' => $failureCount]);

            if ($failureCount > 0) {
                $failures = $import->failures();
                Log::warning('Import had failures', ['failureCount' => $failureCount, 'firstFailure' => $failures->first()]);
                return redirect()->back()->withFailures($failures);
            }

            return redirect()->back()->with('success', 'Data Imported Successfully');
        } catch (ValidationException $e) {
            dd($e->errors());

            Log::error('Validation failed during import', [
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
                'failures' => $e->failures(),
            ]);
            return redirect()->back()->with('error', 'Validation Failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Import failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Data Import Failed: ' . $e->getMessage());
        }
    }


    public function showImport(Request $request)
    {
        return view('content.pages.pages-import-suppliers');
    }
}
