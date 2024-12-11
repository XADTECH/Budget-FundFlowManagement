<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model
{
    use HasFactory;
    protected $table = 'third_parties';
    protected $fillable = [
        'project_id',
        'description',
        'amount',
    ];

    // Define the relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
