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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('limit');
            $table->enum('status',[' inStock','outOfStock','lowStock']);
            $table->unsignedBigInteger('product_id')->nullable(); // Add a foreign key column
            $table->foreign('product_id')->references('id')->on('products');

            $table->unsignedBigInteger('store_id')->nullable(); // Add a foreign key column
            $table->foreign('store_id')->references('id')->on('stores');

            
             // Set up foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
