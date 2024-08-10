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
        Schema::create('car_finance_operations', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id')->nullable();
            $table->integer('price_type_id')->nullable();
            $table->double('amount', 9, 3)->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_finance_operations');
    }
};
