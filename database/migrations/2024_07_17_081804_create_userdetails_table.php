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
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
           
            $table->string('phone');
            $table->string('address');

            $table->unsignedBigInteger('billing_id')->nullable(); // Add a foreign key column
            $table->foreign('billing_id')->references('id')->on('billings'); // Set up foreign key constraint
           
            $table->unsignedBigInteger('user_id')->nullable(); // Add a foreign key column
            $table->foreign('user_id')->references('id')->on('users'); // Set up foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdetails');
    }
};
