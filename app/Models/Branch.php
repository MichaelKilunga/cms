<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'church_id'];

    /**
     * Get the church that owns the branch.
     */
    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id');
    }
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
