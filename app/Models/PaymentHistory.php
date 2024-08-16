<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'class',
        'student_id',
        'class_year',
        'roll_no',
        'particular',
        'pay_month',
        'payment',
        'discount',
        'free_fee',
        'comment_discount',
        'comment_free_fee',
        'dues',
        'pay_with',
        'pay_date',
        'processed_by'
    ];
}