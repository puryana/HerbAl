<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->string('harga');
            $table->string('gambar');
            $table->text('deskripsi');
            $table->text('manfaat');
            $table->text('efekSamping');
            $table->text('waktuKonsumsi');

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')
            ->onUpdate('cascade') // Update foreign key jika parent berubah
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
