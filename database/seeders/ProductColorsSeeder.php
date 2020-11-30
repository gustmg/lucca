<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_colors')->insert([
            ['product_color_name' => 'Negro'],
            ['product_color_name' => 'Gris'],
            ['product_color_name' => 'Rojo'],
            ['product_color_name' => 'Azul'],
            ['product_color_name' => 'Azul Italia'],
            ['product_color_name' => 'Naranja'],
            ['product_color_name' => 'Vino'],
            ['product_color_name' => 'Verde'],
            ['product_color_name' => 'Amarillo'],
            ['product_color_name' => 'Amarillo Neón'],
            ['product_color_name' => 'Verde Neón'],
            ['product_color_name' => 'Rosa Neón'],
            ['product_color_name' => 'Blanco'],
            ['product_color_name' => 'Fucsia'],
            ['product_color_name' => 'Coral'],
            ['product_color_name' => 'Morado'],
            ['product_color_name' => 'Azul Marino'],
            ['product_color_name' => 'Azul Rey'],
            ['product_color_name' => 'Azul Neón'],
        ]);
    }
}
