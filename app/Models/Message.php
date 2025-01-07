<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'body', 'receiver_id', 'type', 'date', 'church_id', 'branch_id', 'status',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the church associated with the message.
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    /**
     * Get the branch associated with the message.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
