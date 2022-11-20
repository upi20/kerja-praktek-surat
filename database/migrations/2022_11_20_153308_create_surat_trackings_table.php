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
        Schema::create('surat_trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_id', false, true)->nullable()->default(null);
            $table->bigInteger('dari_pegawai_id', false, true)->nullable()->default(null);
            $table->bigInteger('ke_pegawai_id', false, true)->nullable()->default(null);
            $table->string('keterangan')->nullable()->default(null);
            $table->dateTime('waktu')->nullable()->default(null);
            $table->string('dari_nama')->nullable()->default(null);
            $table->string('dari_nip')->nullable()->default(null);
            $table->string('ke_nama')->nullable()->default(null);
            $table->string('ke_nip')->nullable()->default(null);
            $table->integer('status')->nullable()->default(0)->comment('0 Penduduk, 1 Rt, 2 Rw, 3 Pihak Desa, 4 Selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_trackings');
    }
};
