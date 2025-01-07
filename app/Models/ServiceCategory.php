<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];
    
    public function services(){
        return $this->hasMany(Service::class);
    }

    public function finances(){
        return $this->hasMany(Finance::class);
    }
}
