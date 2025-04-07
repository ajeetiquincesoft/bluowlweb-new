<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_user_id')->unsigned();
            $table->foreign('vendor_user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->bigInteger('employee_user_id')->unsigned();
            // $table->foreign('employee_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->text('profile_pic')->nullable();
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
        Schema::dropIfExists('vendoe_employees');
    }
}
