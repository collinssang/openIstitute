<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDays extends Model
{
    use HasFactory;
    protected  $fillable = [
        'leave_type',
        'entitled_days'
    ];
}
