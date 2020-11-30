<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_genders')->insert([
            ['product_gender_name' => 'Todos'],
            ['product_gender_name' => 'Hombre'],
            ['product_gender_name' => 'Mujer'],
            ['product_gender_name' => 'Unisex'],
            ['product_gender_name' => 'Infantil']
        ]);
    }
}
