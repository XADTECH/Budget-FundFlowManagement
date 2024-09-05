<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function download()
    {
        // Load the view
        $pdf = Pdf::loadView('content.pages.pages-budget-project-summary-report')
        ->setPaper('A4', 'portrait');
        
        // Download the PDF
        return $pdf->download('content.pages.pages-budget-project-summary-report.pdf');
    }

    
}
