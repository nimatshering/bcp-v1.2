<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GewogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Gewogs under Bumthang
        DB::table('gewogs')->insert([
            'name' =>'Chokhor',
            'dzongkhag_id' =>1
        ]);
        DB::table('gewogs')->insert([
            'name' =>'Chumey',
            'dzongkhag_id' =>1
        ]);
        DB::table('gewogs')->insert([
            'name' =>'Tang',
            'dzongkhag_id' =>1
        ]);
        DB::table('gewogs')->insert([
            'name' =>'Ura',
            'dzongkhag_id' =>1
        ]);

        //Gewogs under Chukha
        DB::table('gewogs')->insert([
            'name' =>'Bjagchhog',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Bongo',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Chapchha',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Darla',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Doongna',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Geling',
            'dzongkhag_id' =>2
        ]);
        
        DB::table('gewogs')->insert([
            'name' =>'Getana',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Loggchina',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Maedtabkha',
            'dzongkhag_id' =>2
        ]);
        
        DB::table('gewogs')->insert([
            'name' =>'Phuntsholing',
            'dzongkhag_id' =>2
        ]);

        DB::table('gewogs')->insert([
            'name' =>'Samphelling',
            'dzongkhag_id' =>2
        ]);

        //Gewogs under Dagana
        DB::table('gewogs')->insert([
            'name' =>'Dorona',
            'dzongkhag_id' =>3
        ]);
    }
}
