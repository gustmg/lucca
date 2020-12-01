<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Ciclismo',
                'category_brand_id' => 1,
            ],
            [
                'category_name' => 'Motociclismo',
                'category_brand_id' => 1,
            ],
            [
                'category_name' => 'Fitness',
                'category_brand_id' => 1,
            ],
            [
                'category_name' => 'Hombre',
                'category_brand_id' => 2,
            ],
            [
                'category_name' => 'Mujer',
                'category_brand_id' => 2,
            ],
            [
                'category_name' => 'Unisex',
                'category_brand_id' => 2,
            ],
        ]);
    }
}
