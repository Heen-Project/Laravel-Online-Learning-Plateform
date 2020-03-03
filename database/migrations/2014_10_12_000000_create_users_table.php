<?php

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
            $table->increments('id');
            $table->string('username')->unique()->nullable();
            $table->string('facebookId')->unique()->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->string('role')->default('user');
            $table->boolean('active')->default(1);
            $table->string('avatar')->nullable();
            $table->integer('point')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->boolean('subscribe')->default(0)->nullable();
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
        Schema::drop('users');
    }
}
