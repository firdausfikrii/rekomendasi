<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        Grade::insert([

            [
                'student_id'=>1,
                'course_name'=>'Algoritma',
                'grade'=>'A'
            ],

            [
                'student_id'=>1,
                'course_name'=>'Basis Data',
                'grade'=>'A'
            ],

            [
                'student_id'=>1,
                'course_name'=>'Pemrograman Web',
                'grade'=>'B+'
            ],

            [
                'student_id'=>2,
                'course_name'=>'Jaringan Komputer',
                'grade'=>'A'
            ],

            [
                'student_id'=>3,
                'course_name'=>'Big Data',
                'grade'=>'A-'
            ],

            [
    'student_id'=>4,
    'course_name'=>'Data Mining',
    'grade'=>'A'
],

[
    'student_id'=>4,
    'course_name'=>'Machine Learning Dasar',
    'grade'=>'A-'
],

[
    'student_id'=>5,
    'course_name'=>'Rekayasa Perangkat Lunak',
    'grade'=>'A'
],

[
    'student_id'=>5,
    'course_name'=>'Pemrograman Mobile',
    'grade'=>'B+'
]
        ]);
    }
}