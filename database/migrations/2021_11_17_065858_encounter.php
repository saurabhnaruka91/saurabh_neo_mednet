<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Encounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounter', function (Blueprint $table) {
            $table->id();
            $table->integer('ClaimID')->nullable();
            $table->string('FacilityID');
            $table->boolean('Type')->nullable();
            $table->integer('PatientID')->nullable();
            $table->dateTime('Start');
            $table->dateTime('End');
            $table->tinyInteger('StartType');
            $table->tinyInteger('EndType');
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
        Schema::dropIfExists('encounter');
    }
}
