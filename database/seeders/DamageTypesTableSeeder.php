<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DamageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('damage_types')->insert([
            [
                'name'      => json_encode(['en' => 'bag'  , 'ar' => 'الشنطة' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'engine'  , 'ar' => 'الماتور' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
