<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        Interest::insert([
            ['name' => ' Rekayasa Perangkat Lunak'],
            ['name' => ' Kecerdasan Buatan & Data'],
            ['name' => 'Jaringan & Keamanan Siber']
        ]);
    }
}