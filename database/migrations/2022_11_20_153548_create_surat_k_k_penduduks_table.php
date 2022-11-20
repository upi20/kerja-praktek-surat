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
        Schema::create('surat_k_k_penduduks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_kk_id', false, true)->nullable()->default(null);
            $table->bigInteger('ibu_id', false, true)->nullable()->default(null);
            $table->bigInteger('ayah_id', false, true)->nullable()->default(null);

            $table->string('nik')->nullable()->default(null);
            $table->string('nama')->nullable()->default(null);
            $table->string('nik_jenis')->nullable()->default(null)->comment('No KTP, KTP Sementara');
            $table->string('jenis_kelamin')->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->string('agama')->nullable()->default(null);
            $table->string('pendidikan')->nullable()->default(null);
            $table->string('pekerjaan')->nullable()->default(null);
            $table->string('status_kawin')->nullable()->default(null);
            $table->string('hub_dgn_kk')->nullable()->default(null);
            $table->string('warga_negara')->nullable()->default(null);
            $table->string('negara_nama')->nullable()->default(null);
            $table->string('no_passport')->nullable()->default(null);
            $table->string('kitas_kitap')->nullable()->default(null);
            $table->string('foto_ktp')->nullable()->default(null);

            $table->timestamps();
            $table->foreign('surat_kk_id')
                ->references('id')->on('surat_k_k_s')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('ayah_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('ibu_id')
                ->references('id')->on('penduduks')
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
        Schema::dropIfExists('surat_k_k_penduduks');
    }
};
