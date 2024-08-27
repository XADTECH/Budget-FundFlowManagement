<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClient extends Model
{
  use HasFactory;

  protected $table = 'business_clients';

  protected $fillable = ['clientname', 'clientdetail', 'clientremark', 'status'];
}
