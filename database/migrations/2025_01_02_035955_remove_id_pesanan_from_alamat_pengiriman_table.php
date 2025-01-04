<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdPesananFromAlamatPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alamat_pengiriman', function (Blueprint $table) {
            $table->dropForeign(['id_pesanan']); // Hapus foreign key
            $table->dropColumn('id_pesanan');   // Hapus kolom
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alamat_pengiriman', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pesanan')->nullable(); // Tambahkan kolom kembali
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade'); // Tambahkan kembali foreign key
        });
    }
}
