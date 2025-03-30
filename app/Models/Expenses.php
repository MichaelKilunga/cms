<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'purpose',
        'item',
        'unit_price',
        'quantity',
        'total_amount',
        'requested_by',
        'approved_by',
        'approval_reason',
        'status',
        'church_id',
        'branch_id',
        'service_id',
        'request_date',
        'required_before',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    
    public function church()
    {
        return $this->belongsTo(Church::class,'church_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
