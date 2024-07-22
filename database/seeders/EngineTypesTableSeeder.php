<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EngineTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engine_types')->insert([
            [
                'name'      => json_encode(['en' => '1600l'  , 'ar' => '١٦٠٠' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => '1800l'  , 'ar' => '١٨٠٠' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
