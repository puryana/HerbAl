<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPengirimanToPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengiriman')->nullable()->after('id'); // Tambahkan kolom id_pengiriman
            $table->foreign('id_pengiriman')->references('id_pengiriman')->on('alamat_pengiriman')->onDelete('set null'); // Tambahkan foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign(['id_pengiriman']); // Hapus foreign key
            $table->dropColumn('id_pengiriman');   // Hapus kolom
        });
    }
}
