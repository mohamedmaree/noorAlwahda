<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
            [
                'name'      => json_encode(['en' => 'first warehouse'  , 'ar' => 'المستودع الاول' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'second warehouse'  , 'ar' => 'المستودع التاني' ] , JSON_UNESCAPED_UNICODE)  , 
            ] 
        ]);
    }
}
