<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
  use HasFactory;

  protected $table = 'business_units';

  protected $fillable = ['id', 'source', 'unitdetail', 'unitremark', 'status'];
}