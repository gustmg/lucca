<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_exits', function (Blueprint $table) {
            $table->unsignedBigInteger('exit_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('product_exit_amount');
            $table->timestamps();

            $table->foreign('exit_id')->references('exit_id')->on('exits');
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
        Schema::dropIfExists('product_exits');
    }
}
