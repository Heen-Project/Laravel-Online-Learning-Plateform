<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('categoryId')->unsigned();
            $table->string('title')->unique();
            $table->longtext('description');
            $table->integer('viewCount')->default(0);
            $table->boolean('approval')->default(0);
            $table->boolean('adminCheck')->default(0);

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('lesson_categories')->onDelete('cascade');
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
        Schema::drop('lessons');
    }
}
