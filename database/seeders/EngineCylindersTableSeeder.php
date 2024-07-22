<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EngineCylindersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engine_cylinders')->insert([
            [
                'name'      => json_encode(['en' => '4'  , 'ar' => '٤' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => '6'  , 'ar' => '٦' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
