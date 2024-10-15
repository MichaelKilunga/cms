<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_date',
        'service_name',
        'message',
        'minister',
        'total_attendance',
        'male',
        'female',
        'children',
        'baptism_water',
        'baptism_spirit',
        'new_births',
        'first_timers',
        'cars',
        'worship_offering',
        'tithe_offering',
        'thanksgiving_offering',
        'project_offering',
        'special_offering',
        'firstfruits_offering',
        'children_offering',
        'Cds_dvd_tapes',
        'books_and_stickers',
    ];
}
