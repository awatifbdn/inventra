<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_xx_xx_create_products_table.php

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('productName');
        $table->string('category');
        $table->text('description')->nullable();
        $table->string('sizes')->default(0);
        $table->decimal('min_price', 10, 2)->default(0);
        $table->decimal('max_price', 10, 2)->default(0);
        $table->json('image_url')->nullable(); // Store array of image URLs
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};