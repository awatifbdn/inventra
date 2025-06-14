<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   // database/factories/ProductFactory.php

public function definition(): array
{
    return [
        'productName' => $this->faker->words(2, true),
        'category' => $this->faker->randomElement(['Interior', 'Exterior', 'Wood', 'Metal']),
        'sizes' => '1L, 5L, 10L',
        'min_price' => 30,
        'max_price' => 100,
        'description' => $this->faker->sentence(),
        'image_url' => json_encode([]),
    ];
}

}
