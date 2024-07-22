<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class transmissionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transmission_types')->insert([
            [
                'name'      => json_encode(['en' => 'automatic'  , 'ar' => 'اتوماتيك' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'manual'  , 'ar' => 'يدوي' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
