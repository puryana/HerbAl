<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran'); // Primary Key
            $table->unsignedBigInteger('id_pesanan'); // Foreign key ke tabel 
            $table->string('payment_gateway', 50); // Gateway pembayaran, contoh: Midtrans, PayPal
            $table->string('transaction_id', 100); // ID transaksi dari gateway pembayaran
            $table->decimal('amount', 12, 2); // Jumlah pembayaran
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending'); // Status pembayaran
            $table->timestamp('payment_date')->nullable(); // Tanggal pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraint
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
        Schema::dropIfExists('pembayaran');
    }
}
