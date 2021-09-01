<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_submission', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('contest_id');
            $table->integer('submission_id');
            $table->integer('user_id');
            $table->integer('exercise_id');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_submission');
    }
}
