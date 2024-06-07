<?php

namespace Database\Seeders;

use App\Models\Links;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seeding data into Link table
        $Linkdata = [
            ['link_type' => 'NKN',],
            ['link_type' => 'NICNet',],
            ['link_type' => 'Direct DF',]
        ];
        DB::table('links')->insert($Linkdata);
    }
}
