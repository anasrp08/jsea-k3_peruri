<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrStatusJsea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_status_jsea', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('id_tender')->nullable();
            $table->bigInteger('id_daftar')->unsigned()->nullable();
            $table->foreign('id_daftar')->references('id')->on('tr_daftar_jsea')->onDelete('cascade');
            
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('tr_status_jsea');
    }
}
