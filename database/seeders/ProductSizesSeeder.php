<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_sizes')->insert([
            [
                'product_size_name' => 'Extra Chica',
                'product_size_reference' => 'XCH',
            ],
            [
                'product_size_name' => 'Chica',
                'product_size_reference' => 'CH',
            ],
            [
                'product_size_name' => 'Mediana',
                'product_size_reference' => 'M',
            ],
            [
                'product_size_name' => 'Grande',
                'product_size_reference' => 'G',
            ],
            [
                'product_size_name' => 'XG',
                'product_size_reference' => 'XG',
            ],
            [
                'product_size_name' => 'XXG',
                'product_size_reference' => 'XXG',
            ],
            [
                'product_size_name' => 'XXXG',
                'product_size_reference' => 'XXXG',
            ],
        ]);
    }
}
