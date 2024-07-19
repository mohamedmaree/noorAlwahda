<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('car_statuses')->insert([
            [
                'name'      => json_encode(['en' => 'Shipped'  , 'ar' => 'تم شحنها' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'delivered'  , 'ar' => 'تم تسليمها' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
