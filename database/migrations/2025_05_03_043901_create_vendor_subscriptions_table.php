<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('subscriptions_id')->unsigned();
            $table->foreign('subscriptions_id')->references('id')->on('subscriptions')->onDelete('cascade');

            $table->string('stripe_subscription_id');

            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->string('status')->comment('Use 0 to Pending status and 1 to confirmed status 2 for due Payment')->default(0);
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
        Schema::dropIfExists('vendor_subscriptions');
    }
}
