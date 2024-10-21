<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MAgeSeeder extends Seeder
{

    public function run()
    {
        DB::table('m_ages')->insert([
            ['age_range' => '～20', 'min_age' => 0, 'max_age' => 20],
            ['age_range' => '21～30', 'min_age' => 21, 'max_age' => 30],
            ['age_range' => '31～40', 'min_age' => 31, 'max_age' => 40],
            ['age_range' => '41～50', 'min_age' => 41, 'max_age' => 50],
            ['age_range' => '51～60', 'min_age' => 51, 'max_age' => 60],
            ['age_range' => '61～', 'min_age' => 61, 'max_age' => null], // 61歳以上
        ]);
    }
}
