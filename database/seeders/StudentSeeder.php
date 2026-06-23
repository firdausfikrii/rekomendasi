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
                'career_preference' => 'AI'
            ],
            [
                'nim' => '220102',
                'nama' => 'Budi',
                'career_preference' => 'Cyber Security'
            ],
            [
                'nim' => '220103',
                'nama' => 'Citra',
                'career_preference' => 'Data Science'
            ]
        ]);
    }
}
