<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudentMarks extends Model
{
    use HasFactory;

    protected $fillable = [
        'st_id',
         'exam',
         'class',
         'section',
         'subject', 
         'total_subject_mark',
         'marks_obtained', 
         'total_marks', 
         'minimum_marks', 
         'attendance', 
         'exam_year',
         'total_th',
         'total_pr',
         'pass_th',
         'pass_pr',
         'obt_th_mark',
         'obt_pr_mark',
         'obt_th_grade',
         'obt_pr_grade',
         'grade_point',
         'grade_name',
         'remark',
        ];
}
