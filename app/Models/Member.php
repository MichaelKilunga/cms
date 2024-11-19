<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'location',
        'occupation',
        'dini_dhehebu',
        'spiritual_status',
        'description',
        'branch_id',
        'age_group',
        'added_by',
    ];

    public function members() {
        return $this->belongsTo(Branch::class);
    }

}
