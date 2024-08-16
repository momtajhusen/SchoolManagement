<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAndPermissionUsers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number',
        'email',
        'password',
        'role_type',
        'email_verification',
    ];
}
