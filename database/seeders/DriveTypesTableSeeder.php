<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class DriveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drive_types')->insert([
            [
                'name'      => json_encode(['en' => 'Rear wheel drive'  , 'ar' => 'دفع خلفي' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'Front pull'  , 'ar' => 'سحب امامي' ] , JSON_UNESCAPED_UNICODE)  , 
            ]
        ]);
    }
}
