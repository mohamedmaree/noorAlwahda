<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('key', 100)->default('+965');
            $table->string('currency', 100)->nullable();
            $table->string('currency_code', 100)->nullable();
            $table->double('exchange_rate', 9, 3)->nullable();
            $table->string('iso2', 100)->nullable();
            $table->string('iso3', 100)->nullable();
            $table->string('flag', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
