<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class FuelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fuel_types')->insert([
            [
                'name'      => json_encode(['en' => 'gaz'  , 'ar' => 'غاز' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'petrol'  , 'ar' => 'بنزين' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
