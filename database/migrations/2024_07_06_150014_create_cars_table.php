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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_num', 50)->nullable(); //! create with new order dynamic
            $table->string('lot', 50)->nullable(); //! create with new order dynamic
            $table->string('vin', 50)->nullable(); //! create with new order dynamic
            $table->integer('user_id')->nullable();//foreignId('captain_id')->constrained()->references('id')->on('captains')->onDelete('set null');
            
            $table->integer('car_brand_id')->nullable();
            $table->integer('car_model_id')->nullable();
            $table->integer('car_year_id')->nullable();
            $table->integer('car_color_id')->nullable();
            $table->integer('car_status_id')->nullable();
            // $table->string('car_letters')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
