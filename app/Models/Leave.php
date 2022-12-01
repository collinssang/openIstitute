<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_type',
        'user_id',
        'leave_status',
        'start_date',
        'end_date',
        'start_date_time',
        'end_date_time',
        'days',
        'reason'
    ];
}
