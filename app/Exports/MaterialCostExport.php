<?php

namespace App\Exports;

use App\Models\MaterialCost;
use Maatwebsite\Excel\Concerns\FromCollection;

class MaterialCostExport implements FromCollection
{
    protected $id;

    // Constructor to receive the id
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return MaterialCost::where('direct_cost_id', $this->id)->get();
    }
}
