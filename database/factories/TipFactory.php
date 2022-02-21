<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tip>
 */
class TipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model_id' => Model::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_for_all_versions' => $this->faker->boolean,
        ];
    }
}
