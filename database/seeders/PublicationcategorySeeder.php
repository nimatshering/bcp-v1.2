<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class PublicationcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publicationcategories')->insert([
            'name' =>'Climate',
            'slug' =>'climate',
        ]);

        DB::table('publicationcategories')->insert([
            'name' =>'Water',
            'slug' =>'water'
        ]);

        DB::table('publicationcategories')->insert([
            'name' =>'Disaster',
            'slug' =>'disaster'
        ]);
    }
}
