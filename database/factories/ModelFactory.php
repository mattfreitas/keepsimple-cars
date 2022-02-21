<?php

namespace Database\Factories;

use App\Models\Make;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'make_id' => Make::all()->random()->id,
            'vehicle_type_id' => VehicleType::all()->random()->id,
            'name' => $this->faker->vehicleModel,
            'version' => $this->faker->randomElement(['1.0', '1.6', '2.0']),
        ];
    }
}
