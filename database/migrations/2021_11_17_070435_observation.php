<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Observation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation', function (Blueprint $table) {
            $table->id();
            $table->integer('ClaimID');
            $table->integer('activityID');
            $table->string('Type')->nullable();
            $table->string('Code');
            $table->string('Value')->nullable();
            $table->string('ValueType');
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
        Schema::dropIfExists('observation');
    }
}
