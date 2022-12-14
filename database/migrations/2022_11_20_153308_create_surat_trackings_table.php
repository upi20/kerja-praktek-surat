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
            $table->text('catatan')->nullable()->default(null);
            $table->dateTime('waktu')->nullable()->default(null);
            $table->string('dari_nama')->nullable()->default(null);
            $table->string('dari_nip')->nullable()->default(null);
            $table->string('ke_nama')->nullable()->default(null);
            $table->string('ke_nip')->nullable()->default(null);
            $table->string('status')->nullable()->default(0)->comment('PENDUDUK, RUKUN TETANGGA, RUKUN WARGA, PIHAK DESA, SELESAI, DIBATALKAN');

            $table->timestamps();
            $table->bigInteger('updated_by', false, true)->nullable()->default(null);
            $table->bigInteger('created_by', false, true)->nullable()->default(null);
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();

            $table->foreign('dari_pegawai_id')->references('id')->on('pegawais')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('ke_pegawai_id')->references('id')->on('pegawais')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('surat_id')
                ->references('id')->on('surats')
                ->nullOnDelete()
                ->cascadeOnUpdate();
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
