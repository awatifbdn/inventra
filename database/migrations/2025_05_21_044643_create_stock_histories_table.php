<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('stock_histories', function (Blueprint $table) {
    $table->id();
    $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade');
    $table->enum('entry_type', ['in', 'out']);
    $table->integer('quantity');
    $table->date('entry_date');
    $table->text('note')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_histories');
    }
};
