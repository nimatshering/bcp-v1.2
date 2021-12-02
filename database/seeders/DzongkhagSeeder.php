<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DzongkhagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert dzongkhags
        DB::table('dzongkhags')->insert([
            'name' =>'Bumthang'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Chukha'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Dagana'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Gasa'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Haa'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Lhuentse'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Mongar'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Paro'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Pemagatshel'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Punakha'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Samdrup Jongkhar'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Samtse'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Sarpang'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Thimphu'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Trashigang'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Trashi Yangtse'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Trongsa'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Tsirang'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Wangdue Phodrang'
        ]);
        DB::table('dzongkhags')->insert([
            'name' =>'Zhemgang'
        ]);
    }
}
