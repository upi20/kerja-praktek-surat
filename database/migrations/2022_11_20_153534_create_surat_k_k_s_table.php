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
        Schema::create('surat_k_k_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_id', false, true)->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('rw_id', false, true)->nullable()->default(null);
            $table->string('no_kk')->nullable()->default(null);
            $table->string('kepala_keluarga')->nullable()->default(null);
            $table->string('alamat')->nullable()->default(null);
            $table->string('kab_kota')->nullable()->default(null);
            $table->string('kecamatan')->nullable()->default(null);
            $table->string('kode_pos')->nullable()->default(null);
            $table->string('provinsi')->nullable()->default(null);
            $table->string('nama_desa')->nullable()->default(null);
            $table->string('rt_nama')->nullable()->default(null);
            $table->string('rw_nama')->nullable()->default(null);

            $table->timestamps();
            $table->foreign('surat_id')
                ->references('id')->on('surats')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('rt_id')
                ->references('id')->on('rts')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('rw_id')
                ->references('id')->on('rws')
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
        Schema::dropIfExists('surat_k_k_s');
    }
};
