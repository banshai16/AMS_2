<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaselineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $leasedata = [
            ['lease_line_provider' => 'BSNL',],
            ['lease_line_provider' => 'PGCIL',],
            ['lease_line_provider' => 'Realtel',]
        ];
        DB::table('lease_line_provider')->insert($leasedata);
    }
}
