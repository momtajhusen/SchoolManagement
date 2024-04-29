<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsInStock extends Model
{
    use HasFactory;
    protected $fillable = ['items', 'categories', 'stock'];
}
