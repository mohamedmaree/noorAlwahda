<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('cars')->insert([
            [  
                'car_num'     => '20241', 
                'lot'     => '123', 
                'vin'     => '987', 
                'user_id'        => 1, 
                'car_brand_id'          => 1, 
                'car_model_id'          => 1, 
                'car_year_id'           => 1, 
                'car_color_id'          => 1, 
                'image'             => 'comfort.png',
            ],[
                'car_num'     => '20242', 
                'lot'     => '888', 
                'vin'     => '22222', 
                'user_id'        => 2, 
                'car_brand_id'          => 2, 
                'car_model_id'          => 3, 
                'car_year_id'           => 2, 
                'car_color_id'          => 2, 
                'image'             => 'signature.png',
            ]
        ]);
    }
}
