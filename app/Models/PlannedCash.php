<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlannedCash extends Model
{
  use HasFactory;

  protected $table = 'planned_cash';

  protected $fillable = ['project_id', 'planned_amount', 'received_amount'];

  public function project()
  {
    return $this->belongsTo(Project::class);
  }
}
