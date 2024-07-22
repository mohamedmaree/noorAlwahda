<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BodyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('body_types')->insert([
            [
                'name'      => json_encode(['en' => 'sedan'  , 'ar' => 'سيدان' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'hatch bag'  , 'ar' => 'هاتش باج' ] , JSON_UNESCAPED_UNICODE)  , 
            ] 
        ]);
    }
}
