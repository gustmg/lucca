<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_model', 10);
            $table->string('product_description', 100);
            $table->decimal('product_cost', 8, 2)->default(0.00);
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_gender_id');
            $table->unsignedBigInteger('product_brand_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('product_category_id')->references('product_category_id')->on('product_categories');
            $table->foreign('product_gender_id')->references('product_gender_id')->on('product_genders');
            $table->foreign('product_brand_id')->references('brand_id')->on('brands');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
