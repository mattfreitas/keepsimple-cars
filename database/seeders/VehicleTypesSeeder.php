<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = VehicleType::insert([
            [ 'name' => 'Carro' ],
            [ 'name' => 'Moto' ],
            [ 'name' => 'Caminhão' ],
        ]);
    }
}
