<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id('color_id'); // Primary Key
            $table->string('color_name');
            $table->string('color_code'); // e.g., HEX: #FFFFFF
            $table->string('color_pallet'); // Optional: e.g., 'Warm', 'Cool', etc.
            $table->decimal('price', 8, 2); // e.g., 99.99
            $table->decimal('litre', 5, 2); // e.g., 5.00 litres
            $table->unsignedBigInteger('category_id'); // Foreign Key
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};