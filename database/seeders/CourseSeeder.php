<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [

            // REKAYASA PERANGKAT LUNAK
            [
                'kode' => 'RPL01',
                'nama' => 'Bengkel Pemrograman Framework',
                'bidang' => 'Rekayasa Perangkat Lunak',
                'sks' => 3
            ],
            [
                'kode' => 'RPL02',
                'nama' => 'Pemrograman Berorientasi Objek Lanjut',
                'bidang' => 'Rekayasa Perangkat Lunak',
                'sks' => 3
            ],
            [
                'kode' => 'RPL03',
                'nama' => 'Pemrograman Game',
                'bidang' => 'Rekayasa Perangkat Lunak',
                'sks' => 3
            ],
            [
                'kode' => 'RPL04',
                'nama' => 'Arsitektur Perangkat Lunak & Design Pattern',
                'bidang' => 'Rekayasa Perangkat Lunak',
                'sks' => 3
            ],
            [
                'kode' => 'RPL05',
                'nama' => 'Mobile Application Development',
                'bidang' => 'Rekayasa Perangkat Lunak',
                'sks' => 3
            ],

            // AI & DATA
            [
                'kode' => 'AI01',
                'nama' => 'Data Warehouse',
                'bidang' => 'Kecerdasan Buatan & Data',
                'sks' => 3
            ],
            [
                'kode' => 'AI02',
                'nama' => 'Machine Learning',
                'bidang' => 'Kecerdasan Buatan & Data',
                'sks' => 3
            ],
            [
                'kode' => 'AI03',
                'nama' => 'Digital Image Processing',
                'bidang' => 'Kecerdasan Buatan & Data',
                'sks' => 3
            ],
            [
                'kode' => 'AI04',
                'nama' => 'Pengenalan Pola (Pattern Recognition)',
                'bidang' => 'Kecerdasan Buatan & Data',
                'sks' => 3
            ],
            [
                'kode' => 'AI05',
                'nama' => 'Pemrosesan Bahasa Alami',
                'bidang' => 'Kecerdasan Buatan & Data',
                'sks' => 3
            ],

            // JARINGAN & KEAMANAN
            [
                'kode' => 'NET01',
                'nama' => 'Keamanan Jaringan',
                'bidang' => 'Jaringan & Keamanan Siber',
                'sks' => 3
            ],
            [
                'kode' => 'NET02',
                'nama' => 'Digital Forensics / Network Forensics',
                'bidang' => 'Jaringan & Keamanan Siber',
                'sks' => 3
            ],
            [
                'kode' => 'NET03',
                'nama' => 'Cloud Computing & Virtualization',
                'bidang' => 'Jaringan & Keamanan Siber',
                'sks' => 3
            ],
            [
                'kode' => 'NET04',
                'nama' => 'Pemrograman IoT',
                'bidang' => 'Jaringan & Keamanan Siber',
                'sks' => 3
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}