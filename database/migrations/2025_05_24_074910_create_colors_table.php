<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id(); // Default PK named 'id'
            $table->string('color_name');
            $table->string('color_code')->nullable(); // HEX like #FFFFFF
            $table->string('color_pallet')->nullable(); // Can be text or image filename
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // FK to products.id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};

