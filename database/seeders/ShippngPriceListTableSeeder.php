<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ShippngPriceListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shippng_price_lists')->insert([
            [
                'name'      => json_encode(['en' => 'october shipping list'  , 'ar' => 'قائمة شحن اكتوبر ' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'nobember shipping list'  , 'ar' => 'قائمة شحن نوفمبر' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
