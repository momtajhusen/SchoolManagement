<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusSsfApplyEmp extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'ssf',
        'ba',
        'ls',
    ];
}
