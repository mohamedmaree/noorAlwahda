<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_brands')->insert([
            [
                'name'      => json_encode(['en' => 'Toyota'  , 'ar' => 'تويوتا' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'Mercedes'  , 'ar' => 'مرسيدس' ] , JSON_UNESCAPED_UNICODE)  , 
            ] 
        ]);
    }
}
