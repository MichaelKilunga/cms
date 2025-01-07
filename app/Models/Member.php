<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'church_id',
        'status',
        'description',
        'date_of_birth',
        'phone_number',
        'gender',
    ];

    /**
     * Get the user associated with the member.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the branch the member belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Get the church the member belongs to.
     */
    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id');
    }
}
