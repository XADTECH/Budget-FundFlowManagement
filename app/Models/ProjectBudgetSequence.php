<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBudgetSequence extends Model
{
    use HasFactory;

    protected $table = 'project_budget_sequence';

    protected $fillable = [
        'date',
        'last_sequence',
    ];
}
