<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paint_categories')->insert([
            ['name' => 'Ultrashield'],
            ['name' => 'Kalershield'],
            ['name' => 'Supercoat'],
            ['name' => 'Maxicoat'],
            ['name' => 'Maxicoat Lite'],
            ['name' => 'Glomel'],
        ]);
    }
}
