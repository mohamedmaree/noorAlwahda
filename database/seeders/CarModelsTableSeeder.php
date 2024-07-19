<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_models')->insert([
            [
                'name'      => json_encode(['en' => 'Corola'  , 'ar' => 'كورولا' ] , JSON_UNESCAPED_UNICODE)  , 
                'car_brand_id' => 1,
            ] ,
            [
                'name'      => json_encode(['en' => 'Camry'  , 'ar' => 'كامري' ] , JSON_UNESCAPED_UNICODE)  , 
                'car_brand_id' => 1,
            ] ,
            [
                'name'      => json_encode(['en' => 'C180'  , 'ar' => 'C180' ] , JSON_UNESCAPED_UNICODE)  , 
                'car_brand_id' => 2,
            ] ,
            [
                'name'      => json_encode(['en' => 'E200'  , 'ar' => 'E200' ] , JSON_UNESCAPED_UNICODE)  , 
                'car_brand_id' => 2,
            ] 
        ]);
    }
}
