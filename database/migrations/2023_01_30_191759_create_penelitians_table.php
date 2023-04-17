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
        Schema::create('penelitians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal');
            $table->string("no_penelitian");
            $table->string("no_registrasi_perkara");
            $table->string("no_registrasi_bb");
            $table->string("surat_perintah");
            $table->date("tanggal_sp");
            $table->string("pasal");
            $table->uuid("terdakwa_id");
            $table->text("keterangan_terdakwa");

            $table->uuid("jaksa1");
            $table->uuid("jaksa2");

            $table->uuid("saksi1");
            $table->uuid("saksi2");

            $table->uuid("penyidik");
            $table->uuid("kasi_bb");

            $table->uuid("petugas");
            $table->uuid("penyerah");

            $table->string('peneliti_sk');
            $table->uuid("peneliti1");
            $table->uuid("peneliti2");
            $table->uuid("peneliti3");

            $table->uuid("kepala_rupbasan");

            $table->timestamps();

            $table->foreign('terdakwa_id')->references('id')->on('terdakwas')->onDelete('cascade');

            $table->foreign('jaksa1')->references('id')->on('jaksas')->onDelete('cascade');
            $table->foreign('jaksa2')->references('id')->on('jaksas')->onDelete('cascade');

            $table->foreign('saksi1')->references('id')->on('saksis')->onDelete('cascade');
            $table->foreign('saksi2')->references('id')->on('saksis')->onDelete('cascade');

            $table->foreign('penyidik')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('kasi_bb')->references('id')->on('pegawais')->onDelete('cascade');

            $table->foreign('petugas')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('penyerah')->references('id')->on('pegawais')->onDelete('cascade');

            $table->foreign('peneliti1')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('peneliti2')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('peneliti3')->references('id')->on('pegawais')->onDelete('cascade');

            $table->foreign('kepala_rupbasan')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penelitians');
    }
};
