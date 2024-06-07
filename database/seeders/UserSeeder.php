<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::updateOrCreate([
            'name' => 'SuperAdmin', 
            'email' => 'superadmin@mail.com', 
            'emp_code' => '0', 
            'designation' => 'SuperAdmin', 
            'password' => Hash::make('password'), 
            'role_id' => 1]);
        Users::updateOrCreate([
            'name' => 'Admin', 
            'email' => 'admin@mail.com',
            'emp_code' => '1',  
            'designation' => 'Admin', 
            'password' => Hash::make('password'), 
            'role_id' => 2]);
    }
}
