<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefillCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refill_cars', function (Blueprint $table) {
            $table->bigIncrements('refillCarId');
            $table->unsignedBigInteger('fk_productId');
            $table->unsignedBigInteger('fk_refillId');
            $table->integer('amount');
            $table->timestamps();
            $table->foreign('fk_productId')->references('productId')->on('products')->onDelete('cascade');
            $table->foreign('fk_refillId')->references('refillId')->on('refills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refill_cars');
    }
}
