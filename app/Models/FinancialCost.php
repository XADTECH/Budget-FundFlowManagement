<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Salary;
use App\Models\FacilityCost;
use App\Models\MaterialCost;
use App\Models\PettyCash;
use App\Models\NocPayment;
use App\Models\Subcontractor;
use App\Models\ThirdParty;

class FinancialCost extends Model
{
    use HasFactory;

    protected $table = 'financial_cost';

    protected $fillable = [
        'in_direct_cost_id', // Foreign key reference to DirectCost
        'budget_project_id',
        'percentage',
        'type', // Type of record (Cost)
        'project', // Project name
        'po', // Type of expense (OPEX)
        'expenses', // Specific expense (Salary)
        'total_cost', // Total calculated cost (5,000 * 5 * 5 = 125,000)
    ];

    public function IndirectCost()
    {
        return $this->belongsTo(IndirectCost::class);
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

    use HasFactory;


    // Define the relationship with TotalBudgetAllocated based on the project
    public function totalBudgetAllocated()
    {
        return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
    }

  public function calculateTotalCost($budgetProjectId)
    {
        // Get total costs for related subunits using budget_project_id
        $salaryTotal = Salary::where('budget_project_id', $budgetProjectId)->sum('total_cost');
        $materialTotal = MaterialCost::where('budget_project_id', $budgetProjectId)->sum('total_cost');
        $facilityTotal = FacilityCost::where('budget_project_id', $budgetProjectId)->sum('total_cost');
        $pettyCashTotal = PettyCash::where('project_id', $budgetProjectId)->sum('amount');
        $nocPaymentTotal = NocPayment::where('project_id', $budgetProjectId)->sum('amount');
        
          $subContractorTotal = Subcontractor::where('project_id', $budgetProjectId)->sum('amount');
         $thirdPartyTotal = ThirdParty::where('project_id', $budgetProjectId)->sum('amount');
         
         $perct = $this->percentage / 100;
        
        // Aggregate all totals
        $overallTotalCost = $perct * ($salaryTotal + $materialTotal + $facilityTotal + $pettyCashTotal + $nocPaymentTotal +    $subContractorTotal +   $thirdPartyTotal);

        return $overallTotalCost;
    }

    public function addFinancialCost($expenseHead, $type, $po, $amount, $project, $budget_project_id,$totalDirectCost)
    {

        // dd($expenseHead, $type, $po, $amount, $project, $budget_project_id,$totalDirectCost);
        $indirectCost = IndirectCost::where('budget_project_id', $budget_project_id)->first();

        if ($indirectCost === null) {
            // Create a new IndirectCost
            $cost = new IndirectCost();
            $cost->budget_project_id = $budget_project_id;
            $cost->save();

            // Assign the new IndirectCost's ID to $costOverhead
            $this->in_direct_cost_id = $cost->id;
        } else {
            // If $indirectCost is not null, assign its ID to $this
            $this->in_direct_cost_id = $indirectCost->id;
        }

        $this->type = $type;
        $this->project = $project;
        $this->po = $po;
        $this->expenses = $expenseHead;
        $this->budget_project_id = $budget_project_id;

        switch ($expenseHead) {
            case 'Risk':
                $this->total_cost = $amount * $totalDirectCost ?? 0;
                $this->percentage = 0; 
                break;

            case 'Financial Cost':
                // Sum total_cost for all salaries related to the project
                $this->total_cost = $amount * $totalDirectCost ?? 0;
                $this->percentage = 0; 
                break;

            case 'Other':
                // Set the amount directly for 'Other' expenses
                $this->total_cost = $amount;
                break;

            default:
                // Default calculation if no specific expense head is selected
                $this->total_cost = $amount;
                break;
        }

        $this->save();
    }
    

    // Approve the material entry
    public function approve()
    {
        $this->approval_status = 'Approved';
        $this->save();
    }

    // Reject the material entry
    public function reject()
    {
        $this->approval_status = 'Rejected';
        $this->save();
    }

    // Mark the material entry as pending
    public function pending()
    {
        $this->approval_status = 'Pending';
        $this->save();
    }

    public static function sumTotalCost($budgetProjectId)
    {
        $total_cost = FinancialCost::where('budget_project_id', $budgetProjectId)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        return $total_cost;
    }
}
