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
                'level'             => 'new_cars',
                'car_statuses_ids'  => json_encode(array("1")),
                'sort'              => 1,
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'towing'  , 'ar' => 'تم سحبها'] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category.png',
                'level'             => 'towing',
                'car_statuses_ids'  => json_encode(array("2")),
                'sort'              => 2,
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'warehouse'  , 'ar' => 'تم تخزينها'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'level'             => 'warehouse',
                'car_statuses_ids'  => json_encode(array("3")),
                'sort'              => 3,
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'shipped'  , 'ar' => 'تم شحنها' ] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'level'             => 'shipping',
                'car_statuses_ids'  => json_encode(array("4")),
                'sort'              => 4,
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'in custom'  , 'ar' =>  ' في الميناء'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'level'             => 'custom',
                'car_statuses_ids'  => json_encode(array("5")),
                'sort'              => 5,
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'arrived'  , 'ar' => 'تم وصولها' ] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'level'             => 'ready_collected',
                'car_statuses_ids'  => json_encode(array("6")),
                'sort'              => 6,
                'created_at'        => Carbon::now()
            ]
        ]);

       
    }
}
