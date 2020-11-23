<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('inventoryID');
            $table->unsignedBigInteger('fk_productID');
            $table->unsignedBigInteger('fk_stationID');
            $table->integer('currentAmount');
            $table->integer('targetAmount');
            $table->timestamps();
            $table->foreign('fk_productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('fk_stationID')->references('stationID')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
