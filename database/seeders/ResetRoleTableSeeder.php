<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResetRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->truncate();
        DB::table('role')->insert([
        'id' => 1,
        'role_name' => 'SuperAdmin',
         ]);

         DB::table('role')->insert([
            'id' => 2,
            'role_name' => 'Admin',
             ]);
    DB::statement('ALTER SEQUENCE users_id_seq RESTART WITH 1;');
    }
}
