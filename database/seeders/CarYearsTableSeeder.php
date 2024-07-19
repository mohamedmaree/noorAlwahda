<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CarYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_years')->insert([
            [
                'year'      => '2017',
            ], 
            [
                'year'      => '2018',
            ], 
            [
                'year'      => '2019',
            ], 
            [
                'year'      => '2020',
            ], 
            [
                'year'      => '2021',
            ], 
            [
                'year'      => '2022',
            ], 
            [
                'year'      => '2023',
            ], 
            [
                'year'      => '2024',
            ], 
        ]);
    }
}
