<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            ['color_name' => 'Negro'],
            ['color_name' => 'Gris'],
            ['color_name' => 'Rojo'],
            ['color_name' => 'Azul'],
            ['color_name' => 'Azul Italia'],
            ['color_name' => 'Naranja'],
            ['color_name' => 'Vino'],
            ['color_name' => 'Verde'],
            ['color_name' => 'Amarillo'],
            ['color_name' => 'Amarillo Neón'],
            ['color_name' => 'Verde Neón'],
            ['color_name' => 'Rosa Neón'],
            ['color_name' => 'Blanco'],
            ['color_name' => 'Fucsia'],
            ['color_name' => 'Coral'],
            ['color_name' => 'Morado'],
            ['color_name' => 'Azul Marino'],
            ['color_name' => 'Azul Rey'],
            ['color_name' => 'Azul Neón'],
        ]);
    }
}
