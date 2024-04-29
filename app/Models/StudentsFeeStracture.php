<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsFeeStracture extends Model
{
    use HasFactory;
    protected $fillable = [
        'st_id',
        'year',
        'month',
        'fee_type',
        'amount',
        'fee_stracture_type',
    ];
}
