<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['role_name'=>'SuperAdmin']);
        Role::updateOrCreate(['role_name'=>'Admin']);
        Role::updateOrCreate(['role_name'=>'User']);
    }
}
