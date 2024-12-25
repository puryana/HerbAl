<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan'); 
            $table->unsignedBigInteger('id'); //untuk id_user
            $table->decimal('total', 12, 2); // Total harga
            $table->decimal('biaya_pengiriman', 12, 2); // Biaya pengiriman
            $table->enum('status', ['menunggu', 'dibayar', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu'); // Status 
            $table->string('payment_method', 50)->nullable(); // Metode pembayaran, misalnya Midtrans
            $table->enum('payment_status', ['menunggu', 'berhasil', 'gagal'])->default('menunggu'); // Status pembayaran
            $table->string('no_resi')->nullable();
            $table->string('shipping_name', 50)->nullable();
            $table->string('transaction_id')->nullable();
            $table->json('payment_details')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps(); // Created_at dan updated_at

            // Menambahkan foreign key
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
