<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedBudget extends Model
{
    use HasFactory;

    protected $table = 'approved_budget';

    protected $fillable = [
        'budget_project_id',
        'total_salary',
        'total_facility_cost',
        'total_material_cost',
        'total_cost_overhead',
        'total_financial_cost',
        'total_capital_expenditure',
        'approved_budget',
        'total_opex',
        'total_capex',
        'expected_net_profit_after_tax',
        'expected_net_profit_before_tax',
        'reference_code',
    ];
}
