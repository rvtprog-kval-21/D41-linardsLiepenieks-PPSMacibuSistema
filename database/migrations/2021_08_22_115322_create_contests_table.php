<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('contestStart');
            $table->date('contestEnd');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->boolean('private');
            $table->integer('user_id');
            $table->string('type');
            $table->integer('minScore');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests');
    }
}
