<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AuctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('auctions')->insert([
                [
                    'name'      => json_encode(['en' => 'first aucation'  , 'ar' => 'المزاد الاول' ] , JSON_UNESCAPED_UNICODE)  , 
                ] , [
                    'name'      => json_encode(['en' => 'second aucation'  , 'ar' => 'المزاد التاني' ] , JSON_UNESCAPED_UNICODE)  , 
                ] 
            ]);
    }
}
