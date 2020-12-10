<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refills', function (Blueprint $table) {
            $table->bigIncrements('refillId');
            $table->unsignedBigInteger('fk_stationId');
            $table->unsignedBigInteger('fk_productId');
            $table->integer('amount');
            $table->string('status');
            $table->timestamps();
            $table->foreign('fk_stationId')->references('stationId')->on('stations')->onDelete('cascade');
            $table->foreign('fk_productId')->references('productId')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refills');
    }
}
