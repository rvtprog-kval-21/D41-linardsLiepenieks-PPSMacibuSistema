<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('kods');
            $table->string('nosaukums');
            $table->text('ievaddati');
            $table->text('izvaddati');
            $table->text('definicija');
            $table->integer('iesutijumi')->default('0');
            $table->integer('atrisinajumi')->default('0');
            $table->integer('score')->default('0');
            $table->float('time');
            $table->float('memory');
            $table->timestamps();

            $table->index('uzd_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
