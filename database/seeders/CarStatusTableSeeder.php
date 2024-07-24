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
                'name'      => json_encode(['en' => 'new cars'  , 'ar' => 'جديدة' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'towing'  , 'ar' => 'تم سحبها' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'warehouse'  , 'ar' => 'تم تخزينها' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'shipped'  , 'ar' => 'تم شحنها' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'in custom'  , 'ar' => ' في الميناء' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'arrived'  , 'ar' => 'تم وصولها' ] , JSON_UNESCAPED_UNICODE)  , 
            ] 
        ]);
    }
}
