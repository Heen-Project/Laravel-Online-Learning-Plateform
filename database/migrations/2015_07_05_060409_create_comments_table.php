<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('lessonId')->unsigned()->nullable();
            $table->integer('articleId')->unsigned()->nullable();
            $table->integer('discussionId')->unsigned()->nullable();
            $table->longtext('content');
            $table->boolean('status')->default(1);
            $table->boolean('inappropriate')->default(0);
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lessonId')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('articleId')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('discussionId')->references('id')->on('discussions')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::drop('comments');
    }
}
