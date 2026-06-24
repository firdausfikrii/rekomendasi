<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::insert([

            [
                'nim' => '220101',
                'nama' => 'Andi',
                'career_preference' => 'AI Engineer'
            ],

            [
                'nim' => '220102',
                'nama' => 'Budi',
                'career_preference' => 'Cyber Security Analyst'
            ],

            [
                'nim' => '220103',
                'nama' => 'Citra',
                'career_preference' => 'Mobile Developer'
            ],

            [
                'nim' => '220104',
                'nama' => 'Dewi',
                'career_preference' => 'Data Scientist'
            ],

            [
                'nim' => '220105',
                'nama' => 'Evan',
                'career_preference' => 'Software Engineer'
            ]

        ]);
    }
}