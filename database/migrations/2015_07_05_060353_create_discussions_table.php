<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('categoryId')->unsigned();
            $table->string('title')->unique();
            $table->boolean('status')->default(1);
            $table->integer('viewCount')->default(0);
            $table->longtext('description');
            $table->softDeletes();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('lesson_categories')->onDelete('cascade');
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
        Schema::drop('discussions');
    }
}
