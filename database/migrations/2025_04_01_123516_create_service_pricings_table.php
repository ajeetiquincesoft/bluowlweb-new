<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_pricings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->bigInteger('service_category_id')->unsigned();
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');

            $table->bigInteger('vendor_user_id')->unsigned();
            $table->foreign('vendor_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->integer('value')->nullable();
            $table->integer('status')->comment('0 for Inactive  and 1 for Active')->default(1);
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
        Schema::dropIfExists('service_pricings');
    }
}
