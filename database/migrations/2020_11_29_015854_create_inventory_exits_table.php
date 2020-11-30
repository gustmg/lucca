<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_exits', function (Blueprint $table) {
            $table->id('inventory_exit_id');
            $table->unsignedBigInteger('inventory_exit_user_id');
            $table->timestamps();

            $table->foreign('inventory_exit_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_exits');
    }
}
