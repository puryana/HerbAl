<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanamanObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanaman_obat', function (Blueprint $table) {
            $table->id('id_tanaman');
            $table->string('nama_tanaman');
            $table->string('gambar');
            $table->text('deskripsi');
            $table->text('bagian_tumbuhan');
            $table->text('khasiat');
            $table->text('penggunaan');
            $table->text('efekSamping');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanaman_obat');
    }
}
