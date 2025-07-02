<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('presensis')->insert([
            'user_id' => 2,
            'latitude' => '-7.45756',
            'longitude' => '109.29880',
            'tanggal' => Carbon::createFromFormat('Y-m-d', '2022-08-20'),
            'masuk' => '03:15:00',
            'pulang' => '03:21:00',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
