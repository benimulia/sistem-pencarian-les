<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_kursus', function (Blueprint $table) {
            $table->bigIncrements('id_tempat_kursus');
            $table->integer('id_kategori');
            $table->integer('id_user');
            $table->string('nama_tempat_kursus');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('no_telp');
            $table->string('foto_utama');
            $table->integer('jumlah_pengunjung')->default(0);
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
        Schema::dropIfExists('tempat_kursus');
    }
}
