<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_cars', function (Blueprint $table) {
            $table->bigIncrements('shoppingCarID');
            $table->unsignedBigInteger('fk_productID');
            $table->unsignedBigInteger('fk_saleID');
            $table->integer('amount');
            $table->timestamps();
            $table->foreign('fk_productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('fk_saleID')->references('saleID')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_cars');
    }
}
