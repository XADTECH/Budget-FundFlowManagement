<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function uploadDocumentsForPaymentOrder(Request $request)
    {
        // Validate the request for document upload
        $request->validate([
            'document' => 'required|mimes:pdf,png,jpg,jpeg,xls,xlsx|max:2048', // 2MB max file size
        ]);

        // Handle file upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/paymentOrders', $fileName, 'public'); // Save in a specific folder

            // Additional logic: Store file reference in the database if required

            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully!',
                'file_name' => $fileName,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No document uploaded.',
        ], 400);
    }
}
