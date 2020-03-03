<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            // $table->integer('lessonId')->unsigned()->nullable();        //id=1
            // $table->integer('articleId')->unsigned()->nullable();       //id=4
            // $table->integer('discussionId')->unsigned()->nullable();    //id=3
            // $table->integer('commentId')->unsigned()->nullable();       //id=2
            $table->integer('destinationId')->unsigned()->nullable(); 
            $table->integer('typeId')->unsigned()->nullable();
            $table->integer('point')->default(0);
            $table->string('content')->nullable();
            $table->string('description');

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('lessonId')->references('id')->on('lessons')->onDelete('cascade');
            // $table->foreign('discussionId')->references('id')->on('discussions')->onDelete('cascade');
            // $table->foreign('commentId')->references('id')->on('comment')->onDelete('cascade');
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
        Schema::drop('user_activities');
    }
}
