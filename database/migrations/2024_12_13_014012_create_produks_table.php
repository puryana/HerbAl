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
            $table->integer('stock')->default(0); // Menambahkan kolom stock
            $table->text('deskripsi');
            $table->text('manfaat');
            $table->text('efekSamping');
            $table->text('waktuKonsumsi');
            $table->timestamps(); // Menambahkan created_at dan updated_at secara otomatis

            // Foreign key untuk kategori
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')
                ->onUpdate('cascade')
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
