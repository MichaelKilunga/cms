<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'motto', 'administrator_id'];

    /**
     * Get the administrator of the church.
     */
    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id');
    }
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    
    public function branches()
    {
        return $this->hasMany(Branch::class, 'church_id');
    }
    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
