<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->string('telp');
            // $table->string('alamat');
            // $table->timestamps();
            $table->id();
            $table->string('nama_lengkap');
            $table->string('alamat_domisili');
            $table->string('jenis_kelamin');
            $table->string('pendidikan_terakhir');
            $table->string('jurusan');
            $table->date('hari');               
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
        Schema::dropIfExists('data');
    }
}
