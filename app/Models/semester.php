<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class semester extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
