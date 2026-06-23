<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([

            [
                'kode' => 'MK01',
                'nama' => 'Machine Learning',
                'bidang' => 'AI',
                'sks' => 2
            ],

            [
                'kode' => 'MK02',
                'nama' => 'Deep Learning',
                'bidang' => 'AI',
                'sks' => 2
            ],

            [
                'kode' => 'MK03',
                'nama' => 'Business Intelligence',
                'bidang' => 'Data Science',
                'sks' => 2
            ],

            [
                'kode' => 'MK04',
                'nama' => 'Cyber Security',
                'bidang' => 'Security',
                'sks' => 2
            ],

            [
                'kode' => 'MK05',
                'nama' => 'Internet of Things',
                'bidang' => 'IoT',
                'sks' => 2
            ],

            [
                'kode' => 'MK06',
                'nama' => 'ERP',
                'bidang' => 'Business',
                'sks' => 2
            ]
        ]);
    }
}
