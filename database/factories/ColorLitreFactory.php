<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ColorLitre>
 */
class ColorLitreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
// database/factories/ColorLitreFactory.php

public function definition(): array
{
    return [
        'litre' => $this->faker->randomElement([1, 5, 10]),
        'price' => $this->faker->randomFloat(2, 30, 100),
        'color_id' => \App\Models\Color::factory(),
    ];
}

}
