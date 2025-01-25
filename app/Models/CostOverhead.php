<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\CapitalExpenditure;
use App\Models\IndirectCost;

use Illuminate\Database\Eloquent\Model;

class CostOverhead extends Model
{
    protected $table = 'cost_overhead'; // Ensure the model points to the correct table

    protected $fillable = [
        'in_direct_cost_id', // Foreign key reference to DirectCost
        'budget_project_id', // Foreign key reference to BudgetProject
        'type', // Type of record (Cost)
        'project', // Project name
        'po', // Type of expense (OPEX)
        'expenses', // Specific expense (Salary)
        'amount', // Total amount (decimal)
    ];

    // Define relationships
    public function indirectCost()
    {
        return $this->belongsTo(IndirectCost::class, 'in_direct_cost_id');
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }

    //calculate based on expense
    public function calculateBasedOnExpenseHead($costOverhead, $expenseHead, $indirect, $type, $project, $po, $amount, $budget_project_id)
    {
        $indirectCost = IndirectCost::where('budget_project_id', $budget_project_id)->first();

        if ($indirectCost === null) {
            // Create a new IndirectCost
            $cost = new IndirectCost();
            $cost->budget_project_id = $budget_project_id;
            $cost->save();

            // Assign the new IndirectCost's ID to $costOverhead
            $costOverhead->in_direct_cost_id = $cost->id;
        } else {
            // If $indirectCost is not null, assign its ID to $costOverhead
            $costOverhead->in_direct_cost_id = $indirectCost->id;
        }

        $costOverhead->type = $type;
        $costOverhead->project = $project;
        $costOverhead->po = $po;
        $costOverhead->expenses = $expenseHead;
        $costOverhead->budget_project_id = $budget_project_id;

        // // Perform specific calculations based on the expense head
        // switch ($expenseHead) {
        //     case 'HO Cost':
        //         // Sum percentage_cost for 'Xad Visa' salaries related to the project
        //         $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $budget_project_id)->sum('percentage_cost');

        //         $costOverhead->amount = $amount * $sumAmount ?? 0;
        //         break;

        //     case 'Annual Benefit':
        //         // Sum total_cost for all salaries related to the project
        //         $sumAmount = Salary::where('budget_project_id', $budget_project_id)->sum('percentage_cost');
        //         $costOverhead->amount = $amount * $sumAmount ?? 0;
        //         break;

        //     case 'Insurance Cost':
        //         // Sum percentage_cost for 'Xad Visa' salaries related to the project
        //         $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $budget_project_id)->sum('percentage_cost');
        //         $costOverhead->amount = $amount * $sumAmount ?? 0;
        //         break;

        //     case 'Visa Renewal':
        //         // Sum percentage_cost for 'Xad Visa' salaries related to the project
        //         $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $budget_project_id)->sum('percentage_cost');
        //         $costOverhead->amount = $amount * $sumAmount ?? 0;
        //         break;

        //     case 'Depreciation Tools':
        //         // Sum total_cost for capital expenditures related to the project and divide by 24
        //         $sumAmount = CapitalExpenditure::where('budget_project_id', $budget_project_id)->sum('total_cost') / 24;
        //         $costOverhead->amount = $sumAmount ?? 0;

        //         break;

        //     case 'Other':
        //         // Set the amount directly for 'Other' expenses
        //         $costOverhead->amount = $amount;
        //         break;

        //     default:
        //         // Default calculation if no specific expense head is selected
        //         $costOverhead->amount = $amount;
        //         break;
        // }

        // Save or further processing for $costOverhead
        $costOverhead->save();
    }

    // Calculate depreciation tools based on project ID
    public function depreciationTools($project_id)
    {
        // Sum the total cost for the given project
        return CapitalExpenditure::where('budget_project_id', $project_id)->sum('total_cost') / 24;
    }

    // Calculate total overhead
    public static function calculateTotalOverhead($project_id)
    {
        // Sum of overhead costs for the given project
        $totalCostOverhead = self::where('budget_project_id', $project_id)->sum('amount');

        // Create an instance of CostOverhead
        $costOverheadInstance = new self();

        // Calculate depreciation
        $depreciation = $costOverheadInstance->depreciationTools($project_id); // Ensure project_id is passed here

        // Total overhead
        return $totalCostOverhead;
    }

    // Define the relationship with TotalBudgetAllocated based on the project
    public function totalBudgetAllocated()
    {
        return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
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
        $total_cost = CostOverhead::where('budget_project_id', $budgetProjectId)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        return $total_cost;
    }
}
