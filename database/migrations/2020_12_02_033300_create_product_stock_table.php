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
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('product_amount')->default(0);
            $table->decimal('product_average_cost', 8,2)->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('color_id')->references('color_id')->on('colors');
            $table->foreign('size_id')->references('size_id')->on('sizes');
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
