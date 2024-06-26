<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'st_id',
        'class',
        'class_year',
        'roll_no',
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
        'month_11'
    ];
}