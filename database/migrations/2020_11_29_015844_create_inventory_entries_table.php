<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_entries', function (Blueprint $table) {
            $table->id('inventory_entry_id');
            $table->decimal('inventory_entry_total_cost', 8 , 2);
            $table->unsignedBigInteger('inventory_entry_user_id');
            $table->timestamps();

            $table->foreign('inventory_entry_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_entries');
    }
}
