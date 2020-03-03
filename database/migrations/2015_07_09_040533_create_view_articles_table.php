<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned()->nullable();
            $table->integer('articleId')->unsigned();
            $table->integer('categoryId')->unsigned();
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('articleId')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('lesson_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('view_articles');
    }
}
