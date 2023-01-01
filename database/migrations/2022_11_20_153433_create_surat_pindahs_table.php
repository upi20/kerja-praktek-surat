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
        Schema::create('surat_pindahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_id', false, true)->nullable()->default(null);

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
            $table->string('no_kk')->nullable()->default(null);
            $table->string('warga_negara')->nullable()->default(null);
            $table->string('negara_nama')->nullable()->default(null);
            $table->string('no_passport')->nullable()->default(null);
            $table->string('kitas_kitap')->nullable()->default(null);
            $table->string('foto_ktp')->nullable()->default(null);
            $table->text('alamat')->nullable()->default(null);

            $table->string('ke_provinsi')->nullable()->default(null);
            $table->string('ke_kab_kota')->nullable()->default(null);
            $table->string('ke_kecamatan')->nullable()->default(null);
            $table->string('ke_desa_kel')->nullable()->default(null);
            $table->string('ke_rt')->nullable()->default(null);
            $table->string('ke_rw')->nullable()->default(null);
            $table->text('ke_alamat_lengkap')->nullable()->default(null);
            $table->text('alasan_pindah')->nullable()->default(null);
            $table->integer('jml_pengikut')->nullable()->default(1);

            $table->timestamps();

            $table->foreign('surat_id')
                ->references('id')->on('surats')
                ->nullOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('surat_pindahs');
    }
};
