<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\Color;
use App\Models\ColorLitre;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyProductSeeder extends Seeder
{
    // database/seeders/DummyProductSeeder.php

public function run(): void
{
    Product::factory(5)->create()->each(function ($product) {
        $colors = Color::factory(3)->create(['product_id' => $product->id]);

        foreach ($colors as $color) {
            ColorLitre::factory(2)->create(['color_id' => $color->id]);
        }
    });
}

}
