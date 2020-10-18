<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdNoJsea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_no_jsea', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_jsea');
            $table->string('seksi')->nullable();
            $table->integer('bulang');
            $table->year('tahun');
             
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
        Schema::dropIfExists('md_no_jsea');
    }
}
