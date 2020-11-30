<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_color_id');
            $table->unsignedBigInteger('product_size_id');
            $table->integer('product_stock')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('product_color_id')->references('product_color_id')->on('product_colors');
            $table->foreign('product_size_id')->references('product_size_id')->on('product_sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock');
    }
}