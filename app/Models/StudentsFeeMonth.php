<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsFeeMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'st_id',
        'year',
        'month_0',
        'month_1',
        'month_2',
        'month_3',
        'month_4',
        'month_5',
        'month_6',
        'month_7',
        'month_8',
        'month_9',
        'month_10',
        'month_11',
        'total_fee',
        'total_paid',
        'total_disc',
        'total_dues',
    ];
}
