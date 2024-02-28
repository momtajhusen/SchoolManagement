<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachersAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'tr_id',
        'period_1',
        'period_2',
        'period_3',
        'period_4',
        'period_5',
        'period_6',
        'period_7',
        'period_8',
        'period_9',
        'period_10',
        'total_period',
        'total_present',
        'total_absent',
        'year',
        'date',
    ];
}
