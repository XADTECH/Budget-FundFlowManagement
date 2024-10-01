<?php

namespace App\Imports;

use App\Models\SupplierPrice;
use Maatwebsite\Excel\Concerns\ToModel;

class PriceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Adjust the index based on your actual data structure
        // Assuming purchase date is at index 4 in your rows
        $purchaseDateStr = $row[1]; // Update index as needed
    
        // Validate that the purchase date is not empty
        if (empty($purchaseDateStr)) {
            \Log::error('Purchase date is missing in row', ['row' => $row]);
            return null; // Prevent saving this row if purchase date is missing
        }
    
        // Create a DateTime object from the purchase date string
        $purchaseDate = \DateTime::createFromFormat('m/d/Y', $purchaseDateStr);
    
        // Check if the date conversion was successful
        if ($purchaseDate === false) {
            \Log::error('Invalid purchase date format', ['row' => $row, 'purchase_date' => $purchaseDateStr]);
            return null; // Prevent saving this row if the date is invalid
        }
    
        // Format the date for storage in the database
        $formattedDate = $purchaseDate->format('Y-m-d');
    
        return new SupplierPrice([
            'items_code' => $row[0],
            'purchase_date' => $formattedDate,
            'item_name' => $row[2],
            'supplier_name' => $row[3],
            'uom' => $row[4], // Verify if this should really be UOM (unit of measure)
            'price' => floatval(str_replace(',', '', $row[5])),
            'discount' => isset($row[6]) ? floatval(str_replace(',', '', $row[6])) : null,
            'remarks' => isset($row[7]) ? $row[7] : null,
        ]);
    }
    
}
