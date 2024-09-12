<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BudgetProject;
use App\Models\DirectCost;
use App\Models\IndirectCost;

class RevenuePlan extends Model
{
    use HasFactory;

    protected $table = 'revenue_plans';

    protected $fillable = [
        'budget_project_id',
        'sn',
        'type',
        'contract',
        'project',
        'description',
        'amount',
        'total_profit',
        'net_profit_before_tax',
        'tax',
        'net_profit_after_tax',
        'profit_percentage',
        'approval_status',
    ];

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

    public function directCost()
    {
      return $this->belongsTo(DirectCost::class);
    }

    public function IndirectCost()
    {
      return $this->belongsTo(IndirectCost::class);
    }

        // Calculate net profit before tax 
        public function calculateTotalProfit()
        {
            // Calculate total profit
            $this->total_profit = $this->sum('amount');
            $this->save();
            
            return $this->total_profit;
        }
  

    // Calculate net profit before tax 
    public function calculateNetProfitBeforeTax($totalDirectCost, $totalIndirectCost)
    {
        // Calculate total profit
        $this->net_profit_before_tax = $this->total_profit - ($totalDirectCost + $totalIndirectCost);
        $this->save();
        
        return $this->net_profit_before_tax;
    }

    // Calculate tax
    public function calculateTax()
    {
        $this->tax = $this->net_profit_before_tax * 0.09; // Assuming 9% tax
        $this->save();

        return $this->tax;
    }

    // Calculate net profit after tax
    public function calculateNetProfitAfterTax()
    {
        $this->net_profit_after_tax = $this->net_profit_before_tax - $this->tax;
        $this->save();

        return $this->net_profit_after_tax;
    }

    // Calculate profit percentage
    public function calculateProfitPercentage()
    {
        if ($this->amount > 0) {
            $this->profit_percentage = ($this->net_profit_after_tax / $this->amount) * 100;
        } else {
            $this->profit_percentage = 0;
        }
        $this->save();

        return $this->profit_percentage;
    }

    // Run all calculations
    public function runCalculations()
    {
        $this->calculateTotalProfit();
        $this->calculateNetProfitBeforeTax();
        $this->calculateTax();
        $this->calculateNetProfitAfterTax();            
    }

    public static function sumTotalCost($budgetProjectId)
    {
       $total_cost = RevenuePlan::where('budget_project_id', $budgetProjectId)
       ->where('approval_status', 'approved') // Only approved salaries
       ->sum('net_profit_after_tax');

       return $total_cost;
    }
}
