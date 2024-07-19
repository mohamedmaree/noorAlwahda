<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_colors')->insert([
            [
                'name'      => json_encode(['en' => 'Red'  , 'ar' => 'أحمر' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'Blue'  , 'ar' => 'أزرق' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
