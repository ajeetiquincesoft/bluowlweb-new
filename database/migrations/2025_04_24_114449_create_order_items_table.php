<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->bigInteger('service_categories_id')->unsigned();
            $table->foreign('service_categories_id')->references('id')->on('service_categories')->onDelete('cascade');

            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // price per item
            $table->longText('data')->nullable();

            $table->string('status')->comment('Use 0 to Pending status and 1 to confirmed status 2 for due Payment status 3 for canclled.')->default(0);
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
        Schema::dropIfExists('order_items');
    }
}
