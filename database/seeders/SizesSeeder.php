<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            [
                'size_name' => 'Extra Chica',
                'size_short_name' => 'XCH',
            ],
            [
                'size_name' => 'Chica',
                'size_short_name' => 'CH',
            ],
            [
                'size_name' => 'Mediana',
                'size_short_name' => 'M',
            ],
            [
                'size_name' => 'Grande',
                'size_short_name' => 'G',
            ],
            [
                'size_name' => 'XG',
                'size_short_name' => 'XG',
            ],
            [
                'size_name' => 'XXG',
                'size_short_name' => 'XXG',
            ],
            [
                'size_name' => 'XXXG',
                'size_short_name' => 'XXXG',
            ],
        ]);
    }
}
