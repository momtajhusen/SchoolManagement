<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassOutStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'parents_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'religion',
        'blood_group',
        'phone',
        'email',
        'id_number',
        'id_image',
        'admission_date',
        'class_year',
        'class',
        'section',
        'roll_no',
        'hostel_outi',
        'transport_use',
        'vehicle_root',
        'district',
        'municipality',
        'village',
        'ward_no',
        'login_email',
        'login_password',
        'student_image',
    ];
}
