<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_pengiriman', function (Blueprint $table) {
            $table->id('id_pengiriman'); // Primary Key
            $table->unsignedBigInteger('id'); ///id user
            $table->unsignedBigInteger('id_pesanan'); 
            $table->text('address'); // Alamat pengiriman
            $table->string('city', 255); // Kota
            $table->string('province', 255); // Provinsi
            $table->string('postal_code', 10); // Kode pos
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraints
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_pengiriman');
    }
}
