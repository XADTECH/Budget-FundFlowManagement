<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  use HasFactory;

  protected $table = 'banks';

  protected $fillable = ['id', 'bank_name', 'bank_detail', 'bank_address', 'balance_amount'];
}
