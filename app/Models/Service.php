<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_category_id',
        'date',
        'message',
        'minister',
        'women',
        'men',
        'children',
        'cars',
        'baptism_water',
        'baptism_spirit',
        'new_birth',
        'first_timers',
        'user_id',
        'branch_id',
        'church_id',
        'status',
        'approval_reason',
        'approval_by',
    ];

    /**
     * Get the user who filed the report.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the branch of the service.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Get the church of the service.
     */

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id');
    }

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }


    public function finances()
    {
        return $this->hasMany(Finance::class, 'service_id');
    }
}
