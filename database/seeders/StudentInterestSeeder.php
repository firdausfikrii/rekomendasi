<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentInterestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_interest')->insert([

            [
                'student_id' => 1,
                'interest_id' => 1
            ],

            [
                'student_id' => 1,
                'interest_id' => 2
            ],

            [
                'student_id' => 2,
                'interest_id' => 3
            ],

            [
                'student_id' => 3,
                'interest_id' => 2
            ]
        ]);
        DB::table('student_interest')->insert([
    'student_id' => 4,
    'interest_id' => 2
]);

DB::table('student_interest')->insert([
    'student_id' => 5,
    'interest_id' => 1
]);
    }
}
