<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorit', function (Blueprint $table) {
            $table->id('id_favorit'); // Primary Key
            $table->unsignedBigInteger('id'); // Foreign Key ke users
            $table->unsignedBigInteger('id_ramuan')->nullable(); // Foreign Key ke tabel ramuan
            $table->unsignedBigInteger('id_produk')->nullable(); // Foreign Key ke tabel produk
            $table->unsignedBigInteger('id_tanaman')->nullable(); // Foreign Key ke tabel tanaman
            $table->unsignedBigInteger('id_penyakit')->nullable(); // Foreign Key ke tabel penyakit
            $table->unsignedBigInteger('id_tips')->nullable(); // Foreign Key ke tabel tips
            $table->timestamps(); // Kolom created_at dan updated_at

            // Tambahkan foreign key constraints
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_ramuan')->references('id_ramuan')->on('ramuan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
            $table->foreign('id_tanaman')->references('id_tanaman')->on('tanaman_obat')->onDelete('cascade');
            $table->foreign('id_penyakit')->references('id_penyakit')->on('penyakit')->onDelete('cascade');
            $table->foreign('id_tips')->references('id_tips')->on('tips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorit');
    }
}
