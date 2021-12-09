<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'Non-Admin',
        ]);



        DB::table('authors')->insert([
            'name' => 'Will Shakespare',
        ]);
        DB::table('authors')->insert([
            'name' => 'Danang Satriani',
        ]);
        DB::table('authors')->insert([
            'name' => 'OxyCreative',
        ]);
    }
}
