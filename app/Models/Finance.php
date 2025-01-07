<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id','date', 'worship_offering', 'tithe_offering', 'thanksgiving_offering',
        'project_offering', 'special_offering', 'firstfruits_offering', 'children_offering',
        'cds_dvd_tapes', 'books_and_stickers', 'user_id',
    ];

    /**
     * Get the service associated with the finance record.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get the user who filed the finance report.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class,'service_category_id');
    }
}
