<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'religion',
        'blood_group',
        'phone',
        'email',
        'admission_date',
        'class',
        'section',
        'roll_no',
        'district',
        'municipality',
        'village',
        'ward_no',
        'coaching',
        'hostel_outi',
        'transport_use',
        'vehicle_root',
        // add any other attributes that you want to be able to mass-assign
    ];
}
