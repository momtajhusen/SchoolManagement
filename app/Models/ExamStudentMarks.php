<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudentMarks extends Model
{
    use HasFactory;

    protected $fillable = ['st_id', 'exam', 'class', 'section', 'subject', 'marks_obtained', 'total_marks', 'minimum_marks', 'attendance', 'exam_year'];
}
