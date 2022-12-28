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

            // penduduk yang membuat
            $table->string('nama_penduduk')->nullable()->default(null)->comment("Nama penduduk yang mengajukan");
            $table->string('nik_penduduk')->nullable()->default(null)->comment("NIK penduduk yang mengajukan");

            // untuk penduduk
            $table->string('nama_untuk_penduduk')->nullable()->default(null)->comment("Nama penduduk yang ada di surat");
            $table->string('nik_untuk_penduduk')->nullable()->default(null)->comment("NIK penduduk yang ada di surat");

            $table->string('rt_nik')->nullable()->default(null);
            $table->string('rt_nama')->nullable()->default(null);
            $table->string('rw_nik')->nullable()->default(null);
            $table->string('rw_nama')->nullable()->default(null);
            $table->string('kades_nik')->nullable()->default(null);
            $table->string('kades_nama')->nullable()->default(null);
            $table->string('kades_jabatan')->nullable()->default(null);
            $table->string('no_surat')->nullable()->default(null);
            $table->string('no_resi')->nullable()->default(null);
            $table->string('foto_pbb')->nullable()->default(null);
            $table->string('foto_kk')->nullable()->default(null);
            $table->string('reg_no')->nullable()->default(null)->comment('Ada di atas tanda tangan rw');
            $table->string('tanggal')->nullable()->default(null);
            $table->string('status')->nullable()->default(0)->comment('PENDUDUK, RUKUN WARGA, RUKUN TETANGGA, PIHAK DESA, SELESAI, DIBATALKAN');
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
            $table->bigInteger('updated_by', false, true)->nullable()->default(null);
            $table->bigInteger('created_by', false, true)->nullable()->default(null);
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
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
