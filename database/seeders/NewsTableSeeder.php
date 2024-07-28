<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'content'      => json_encode(['en' => '20% discount on all cars'  , 'ar' => 'خصم ٢٠٪ علي كل السيارات' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'content'      => json_encode(['en' => '50% off shipping'  , 'ar' => 'خصم ٥٠٪ علي الشحن' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
