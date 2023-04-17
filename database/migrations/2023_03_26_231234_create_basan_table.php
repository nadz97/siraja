<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penelitian_id');
            $table->string('no');
            $table->string('nama');
            $table->string('photo')->nullable();
            $table->text('keterangan')->nullable();

            $table->string('jumlah')->nullable();
            $table->string('golongan')->nullable();
            $table->string('kondisi')->nullable();

            $table->string('bentuk')->nullable();
            $table->string('berat')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('ciri')->nullable();
            $table->string('sifat')->nullable();
            $table->string('keadaan')->default('tidak');
            $table->enum('status',
            [
                'entry',
                'on going',
                'pinjam pakai',
                'dirampas negara',
                'dikembalikan',
                'dimusnahkan'
            ])->default("entry");

            $table->timestamps();

            $table->foreign('penelitian_id')->references('id')->on('penelitians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basan');
    }
};
