<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocPayment extends Model
{
    use HasFactory;

    // Define the table name (optional if following Laravel's naming conventions)
    protected $table = 'noc_payments';

    // Define the fillable fields
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
