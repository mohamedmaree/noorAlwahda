<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('categories')->insert([
            [
                'name'              => json_encode(['en' => 'new cars'  , 'ar' => 'جديدة' ] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category.png',
                'car_statuses_ids'  => json_encode(array("1")),
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'towing'  , 'ar' => 'تم سحبها'] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category.png',
                'car_statuses_ids'  => json_encode(array("2")),
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'warehouse'  , 'ar' => 'تم تخزينها'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'car_statuses_ids'  => json_encode(array("3")),
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'shipped'  , 'ar' => 'تم شحنها' ] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'car_statuses_ids'  => json_encode(array("4")),
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'in custom'  , 'ar' =>  ' في الميناء'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'car_statuses_ids'  => json_encode(array("5")),
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'arrived'  , 'ar' => 'تم وصولها' ] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'car_statuses_ids'  => json_encode(array("6")),
                'created_at'        => Carbon::now()
            ]
        ]);

       
    }
}
