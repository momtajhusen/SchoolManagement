<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $fillable = [
        'Kids_id',
        'father_image',
        'father_name',
        'father_mobile',
        'father_education',
        'mother_image',
        'mother_name',
        'mother_education',
        // add any other attributes that you want to be able to mass-assign
    ];
}
