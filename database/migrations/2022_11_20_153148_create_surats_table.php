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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->bigInteger('untuk_penduduk_id', false, true)->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('rt_pend_id', false, true)->nullable()->default(null);
            $table->bigInteger('rw_pend_id', false, true)->nullable()->default(null);
            $table->bigInteger('kades_pend_id', false, true)->nullable()->default(null);
            $table->bigInteger('rw_id', false, true)->nullable()->default(null);

            $table->string('nama_penduduk')->nullable()->default(null);
            $table->string('nik_penduduk')->nullable()->default(null);
            $table->string('nama_untuk_penduduk')->nullable()->default(null);
            $table->string('nik_untuk_penduduk')->nullable()->default(null);

            $table->string('nama_surat')->nullable()->default(null);
            $table->string('rt_nik')->nullable()->default(null);
            $table->string('rt_nama')->nullable()->default(null);
            $table->string('rw_nik')->nullable()->default(null);
            $table->string('rw_nama')->nullable()->default(null);
            $table->string('kades_nik')->nullable()->default(null);
            $table->string('kades_nama')->nullable()->default(null);
            $table->string('no_surat')->nullable()->default(null);
            $table->string('no_resi')->nullable()->default(null);
            $table->string('foto_pbb')->nullable()->default(null);
            $table->string('foto_kk')->nullable()->default(null);
            $table->string('reg_no')->nullable()->default(null);
            $table->string('tanggal')->nullable()->default(null);
            $table->integer('status')->nullable()->default(0)->comment('0 Penduduk, 1 Rt, 2 Rw, 3 Pihak Desa, 4 Selesai');
            $table->string('jenis');

            $table->boolean('dibatalkan')->nullable()->default(0);
            $table->text('alasan_dibatalkan')->nullable()->default(null);
            $table->dateTime('tanggal_dibatalkan')->nullable()->default(null);

            $table->foreign('penduduk_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('untuk_penduduk_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rt_id')
                ->references('id')->on('rts')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rt_pend_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rw_pend_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('kades_pend_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rw_id')
                ->references('id')->on('rws')
                ->nullOnDelete()
                ->cascadeOnUpdate();

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
        Schema::dropIfExists('surats');
    }
};
