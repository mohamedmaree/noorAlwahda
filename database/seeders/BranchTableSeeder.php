<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'name'      => json_encode(['en' => 'first bracnh'  , 'ar' => 'الفرع الاول' ] , JSON_UNESCAPED_UNICODE)  , 
            ] , [
                'name'      => json_encode(['en' => 'second bracnh'  , 'ar' => 'الفرع التاني' ] , JSON_UNESCAPED_UNICODE)  , 
            ] 
        ]);
    }
}
