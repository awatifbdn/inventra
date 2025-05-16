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
        $table->string('subheading')->nullable();
        $table->string('category');
        $table->string('key_features')->nullable();
        $table->string('color')->nullable();
        $table->string('color_code')->nullable();
        $table->integer('stock_quantity')->default(0);
        $table->float('litre')->default(0);
        $table->decimal('price', 10, 2)->default(0);
        $table->text('description')->nullable();
        $table->json('image_url')->nullable(); // Store array of image URLs
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};