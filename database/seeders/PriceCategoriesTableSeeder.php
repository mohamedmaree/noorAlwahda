<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PriceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_categories')->insert([
            [
                'name'              => json_encode(['en' => 'Taxes'  , 'ar' => 'ضرائب' ] , JSON_UNESCAPED_UNICODE) , 
                'price_types_ids'   => json_encode(array("1")),
            ],[
                'name'              => json_encode(['en' => 'customs' , 'ar' => 'جمارك'] , JSON_UNESCAPED_UNICODE) , 
                'price_types_ids'  => json_encode(array("2","3")),
            ],
        ]);
    }
}
