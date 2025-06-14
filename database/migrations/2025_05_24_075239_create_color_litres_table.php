<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('color_litres', function (Blueprint $table) {
            $table->id();
           $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->decimal('litre', 5, 2);
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('color_litres');
    }
};

