<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function semester() {
        return $this->belongsTo(Semester::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function examResult()
{
    return $this->hasOne(ExamResults::class);
}
}

