<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','description', 'status','church_id','branch_id','user_id'];
    
    public function services(){
        return $this->hasMany(Service::class);
    }

    public function church(){
        return $this->belongsTo(Church::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
