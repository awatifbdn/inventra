<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // database/factories/ColorFactory.php

public function definition(): array
{
    return [
        'color_name' => $this->faker->colorName(),
        'color_code' => $this->faker->hexColor(),
        'color_pallet' => null,
        'product_id' => \App\Models\Product::factory(), // Auto-associate
    ];
}

}
