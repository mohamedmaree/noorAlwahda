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
            $table->integer('car_color_id')->nullable();
            $table->integer('car_year_id')->nullable();
            
            $table->integer('car_status_id')->nullable();
            $table->integer('car_damage_type_id')->nullable();
            $table->integer('car_body_type_id')->nullable();
            $table->integer('car_engine_type_id')->nullable();
            $table->integer('car_engine_cylinder_id')->nullable();
            $table->integer('car_transmission_type_id')->nullable();
            $table->integer('car_drive_type_id')->nullable();
            $table->integer('car_fuel_type_id')->nullable();

            $table->integer('auction_id')->nullable();
            $table->string('distance', 50)->nullable(); 
            $table->boolean('key')->nullable(); 

            $table->date('purchasing_date')->nullable(); 
            $table->date('estimation_arrive_date')->nullable(); 
            $table->date('warehouse_arrive_date')->nullable(); 
            $table->date('company_arrive_date')->nullable(); 
            $table->date('port_arrive_date')->nullable(); 
            $table->date('shipping_date')->nullable(); 
            $table->date('towing_date')->nullable(); 

            $table->integer('from_country_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('to_country_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('pickup_location_id')->nullable();//company branch id
            $table->string('container', 50)->nullable(); 
            $table->boolean('available')->nullable(); 

            $table->text('notes')->nullable(); 

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
