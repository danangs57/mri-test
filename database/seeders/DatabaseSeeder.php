<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Finance',
        ]);

        DB::table('roles')->insert([
            'name' => 'NormalUser',
        ]);

        User::factory()->count(17)->create();

        DB::table('positions')->insert([
            'name' => 'Manager',
        ]);

        DB::table('positions')->insert([
            'name' => 'Supervisor',
        ]);

        DB::table('positions')->insert([
            'name' => 'Karyawan',
        ]);
        

        DB::table('salaries')->insert([
            'gaji' => '5000000',
            'pajak' => '15',
        ]);

        DB::table('salaries')->insert([
            'gaji' => '4500000',
            'pajak' => '15',
        ]);

        DB::table('salaries')->insert([
            'gaji' => '4050000',
            'pajak' => '5',
        ]);


    }
}
