<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ColorLitre;
use App\Models\Color;


class ColorLitreFactory extends Factory
{
    protected $model = ColorLitre::class;

    public function definition(): array
    {
        return [
            'color_id' => Color::factory(), // or manually assign in seeder
            'litre' => $this->faker->randomElement([1, 5, 10]),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
