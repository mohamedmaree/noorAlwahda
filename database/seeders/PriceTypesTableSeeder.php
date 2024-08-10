<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PriceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_types')->insert([
            [
                'name'      => json_encode(['en' => 'added value'  , 'ar' => 'ضريبة قيمه مضافة' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'customs'  , 'ar' => 'جمارك' ] , JSON_UNESCAPED_UNICODE)  , 
            ],[
                'name'      => json_encode(['en' => 'Shipping charges' , 'ar' => 'مصاريف شحن' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
