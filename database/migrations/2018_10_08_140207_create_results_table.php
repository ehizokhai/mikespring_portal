<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test')->nullable();
            $table->integer('exam')->nullable();
            $table->unsignedInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->unsignedInteger('classroomsubject_id');
            $table->foreign('classroomsubject_id')->references('id')->on('classroomsubjects');
            $table->unsignedInteger('term_id');
            $table->foreign('term_id')->references('id')->on('terms');
            $table->enum('released', ['true', 'false'])->nullable();
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
        Schema::dropIfExists('results');
    }
}
