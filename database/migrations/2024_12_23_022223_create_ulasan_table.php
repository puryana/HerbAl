<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->unsignedBigInteger('id');  // UID Firebase
            $table->morphs('commentable'); // Polymorphic columns: commentable_id & commentable_type
            $table->text('text')->nullable(); // Ulasan berupa teks
            $table->string('gambar')->nullable(); // URL gambar (opsional)
            $table->tinyInteger('rating')->nullable()->check('rating >= 1 AND rating <= 5'); // Rating 1-5
            $table->timestamps();

            // Foreign key to users table
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
        Schema::dropIfExists('ulasan');
    }
}
