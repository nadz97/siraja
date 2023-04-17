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
        Schema::create('jaksas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('NIP');
            $table->uuid('instansi_id');
            $table->uuid('jabatan_id');
            $table->string('pangkat')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('photo')->nullable();
            $table->text('biodata')->nullable();
            $table->timestamps();

            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jaksas');
    }
};
