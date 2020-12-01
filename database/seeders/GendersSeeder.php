<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            ['gender_name' => 'Hombre'],
            ['gender_name' => 'Mujer'],
            ['gender_name' => 'Unisex'],
            ['gender_name' => 'Infantil']
        ]);
    }
}
