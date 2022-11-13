<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DinnerEvent>
 */
class DinnerEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cook_name' => $this->faker->name(),
            'cook_email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->text(),
            'meat_option' => true,
            'vegetarian_option' => false,
            'vegan_option' => false,
            'event_verified_at' => now(),
        ];
    }
}
