<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrDaftarJsea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_daftar_jsea', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('id_tender')->nullable();
            // $table->integer('id_transaksi');
            $table->string('no_pr')->nullable();
            $table->string('no_tender')->nullable();
            $table->string('no_sppj')->nullable();
            $table->string('no_jsea')->nullable();
            $table->date('tgl_sppj')->nullable(); 
            $table->text('path_file')->nullable();
            $table->text('file_name')->nullable();
            $table->date('tgl_upload')->nullable();
            $table->text('desc_file')->nullable();
            $table->text('id_vendor')->nullable();
            $table->string('vendor')->nullable();
            $table->string('status_tender')->nullable();
            $table->string('status_vendor')->nullable();
            $table->string('status_review')->nullable();
            $table->text('nama_pekerjaan')->nullable();
            $table->string('updated_by')->nullable(); 
            $table->date('tgl_tender')->nullable();
            $table->date('tgl_updtender')->nullable();
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
        Schema::dropIfExists('tr_daftar_jsea');
    }
}
