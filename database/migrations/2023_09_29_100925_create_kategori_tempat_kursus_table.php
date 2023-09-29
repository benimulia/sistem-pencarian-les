<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTempatKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_tempat_kursus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tempat_kursus_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            $table->foreign('tempat_kursus_id')->references('id_tempat_kursus')->on('tempat_kursus')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_tempat_kursus');
    }
}