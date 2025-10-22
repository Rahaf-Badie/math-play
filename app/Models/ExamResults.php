<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResults extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'unit_id', 'score', 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
