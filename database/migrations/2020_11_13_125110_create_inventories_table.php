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
            $table->bigIncrements('inventoryId');
            $table->unsignedBigInteger('fk_productId');
            $table->unsignedBigInteger('fk_stationId');
            $table->integer('currentAmount');
            $table->integer('targetAmount');
            $table->timestamps();
            $table->foreign('fk_productId')->references('productId')->on('products')->onDelete('cascade');
            $table->foreign('fk_stationId')->references('stationId')->on('stations')->onDelete('cascade');
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
