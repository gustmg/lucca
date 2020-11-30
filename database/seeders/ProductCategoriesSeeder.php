<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            ['product_category_name' => 'Todos'],
            ['product_category_name' => 'Ciclismo'],
            ['product_category_name' => 'Motociclismo'],
            ['product_category_name' => 'Fitness'],
            ['product_category_name' => 'Hombre'],
            ['product_category_name' => 'Mujer'],
        ]);
    }
}
