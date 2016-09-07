<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     * Product name, Quantity in stock, Price per item,
     * Datetime submitted, Total value number.
     * The "Total value number" should be calculated as
     * (Quantity in stock * Price per item).
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('stock');
            $table->decimal('price', 9, 2);
            $table->dateTime('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
