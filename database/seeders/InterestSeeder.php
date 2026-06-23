<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        Interest::insert([
            ['name' => 'AI'],
            ['name' => 'Data Science'],
            ['name' => 'Cyber Security'],
            ['name' => 'IoT'],
            ['name' => 'Software Engineering']
        ]);
    }
}