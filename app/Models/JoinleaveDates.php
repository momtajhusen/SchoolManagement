<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinleaveDates extends Model
{
    use HasFactory;

    protected $fillable = 
    ['st_id', 
    'admission_months', 
    'admission_start', 
    'transport_fee', 
    'tuition_fee', 
    'full_hostel_fee', 
    'half_hostel_fee', 
    'computer_fee', 
    'coaching_fee', 
    'admission_fee', 
    'annual_charge',
    'hostel_deposit', 
    'saraswati_puja', 
    'exam_fee'];
}
