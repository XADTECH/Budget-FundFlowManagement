<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlannedCashOpeningBalance extends Model
{
  use HasFactory;

  protected $table = 'planned_cash_opening_balances';

  protected $fillable = ['amount'];
}
