<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'career_preference'
    ];

    public function interests()
    {
        return $this->belongsToMany(
            Interest::class,
            'student_interest'
        );
    }

    public function grades()
    {
        return $this->hasMany(
            Grade::class
        );
    }
}
