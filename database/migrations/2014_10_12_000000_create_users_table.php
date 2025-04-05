<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
			$table->string('phone')->nullable();
            $table->string('password');
			$table->string('licence_number')->nullable();
			$table->text('website_url')->nullable();
			$table->text('yelp_url')->nullable();
			$table->text('about_service')->nullable();
			$table->string('role')->default("admin")->nullable();;
			$table->text('profile_pic')->nullable();
            $table->string('gender')->nullable();;
            $table->string('latitude')->nullable();;
            $table->string('longitude')->nullable();;
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('status')->comment('0 for Inactive  and 1 for Active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
