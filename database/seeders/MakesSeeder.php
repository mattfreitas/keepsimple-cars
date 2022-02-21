<?php

namespace Database\Seeders;

use App\Models\Make;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Make::factory()->count(10)->create();
    }
}
