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
        Schema::create('shoppingcars', function (Blueprint $table) {
            $table->bigIncrements('shoppingcarId');
            $table->unsignedBigInteger('fk_productId');
            $table->unsignedBigInteger('fk_saleId');
            $table->integer('amount');
            $table->timestamps();
            $table->foreign('fk_productId')->references('productId')->on('products')->onDelete('cascade');
            $table->foreign('fk_saleId')->references('saleId')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppingcars');
    }
}
