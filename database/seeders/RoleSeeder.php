<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' =>'admin'
        ]);

        DB::table('roles')->insert([
            'name' =>'agency'
        ]);

        DB::table('roles')->insert([
            'name' =>'forum'
        ]);
    }
}
