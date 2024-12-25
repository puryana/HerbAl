<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id('id_detail_pesanan');
            $table->unsignedBigInteger('id_pesanan'); // Relasi ke tabel pesanan
            $table->unsignedBigInteger('id_produk'); // Relasi ke tabel produk
            $table->integer('jumlah'); // Jumlah produk
            $table->decimal('harga_satuan', 12, 2); // Harga per unit produk
            $table->decimal('subtotal', 12, 2); // Total harga untuk produk ini (jumlah * harga_satuan)
            $table->decimal('diskon', 12, 2)->nullable(); // Diskon per produk (opsional)
            $table->timestamps();
        
            // Relasi foreign key
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
