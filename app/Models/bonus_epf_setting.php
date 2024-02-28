<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bonus_epf_setting extends Model
{
    use HasFactory;
     protected $fillable = [
        'bouns_from',
        'bouns_to',
        'bonus_amount',
        'epf',
    ];
}
