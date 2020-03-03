<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('lessonId')->unsigned();
            $table->string('title')->unique();
            $table->integer('viewCount')->default(0);
            $table->longtext('description');
            
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lessonId')->references('id')->on('lessons')->onDelete('cascade');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
