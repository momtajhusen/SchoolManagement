<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastPaymentForReset extends Model
{
    use HasFactory;
    protected $fillable = [
        'st_id',
        'class',
        'class_year',
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
        'total_payment',
        'total_discount',
        'total_dues',
        'pay_with',
        'pay_date',
    ];
}
