<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Claims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('MemberID');
            $table->string('PayerID');
            $table->string('ProviderID')->nullable();
            $table->string('EmiratesIDNumber')->nullable();
            $table->integer('Gross');
            $table->float('PatientShare')->nullable();
            $table->string('Net')->nullable();
            $table->string('xmlfile')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
