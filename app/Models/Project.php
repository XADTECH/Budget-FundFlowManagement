<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $table = 'projects';

  protected $fillable = ['name', 'projectdetail', 'projectremark', 'status'];

  public function plannedCashes()
  {
    return $this->hasMany(PlannedCash::class);
  }
}
