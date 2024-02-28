<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusSsfSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'ssf_per',
        'bouns_attend',
        'bouns_per',
        'leave_per',
        'leave_salary',
    ];
}
