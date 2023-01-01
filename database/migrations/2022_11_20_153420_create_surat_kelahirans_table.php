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
        Schema::create('surat_kelahirans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_id', false, true)->nullable()->default(null);
            $table->bigInteger('ayah_id', false, true)->nullable()->default(null);
            $table->bigInteger('ibu_id', false, true)->nullable()->default(null);

            $table->string('nama_anak')->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->time('waktu_lahir')->nullable()->default(null);
            $table->integer('anak_ke')->nullable()->default(null);
            $table->integer('berat')->nullable()->default(null);
            $table->integer('panjang')->nullable()->default(null);
            $table->string('jenis_kelamin')->nullable()->default(null);

            // ibu
            $table->string('ibu_nama')->nullable()->default(null);
            $table->string('ibu_nik')->nullable()->default(null);
            $table->string('ibu_nik_jenis')->nullable()->default(null)->comment('No KTP, KTP Sementara');
            $table->string('ibu_jenis_kelamin')->nullable()->default(null);
            $table->string('ibu_tempat_lahir')->nullable()->default(null);
            $table->date('ibu_tanggal_lahir')->nullable()->default(null);
            $table->string('ibu_agama')->nullable()->default(null);
            $table->string('ibu_pendidikan')->nullable()->default(null);
            $table->string('ibu_pekerjaan')->nullable()->default(null);
            $table->string('ibu_status_kawin')->nullable()->default(null);
            $table->string('ibu_no_kk')->nullable()->default(null);
            $table->string('ibu_warga_negara')->nullable()->default(null);
            $table->string('ibu_negara_nama')->nullable()->default(null);
            $table->string('ibu_no_passport')->nullable()->default(null);
            $table->string('ibu_kitas_kitap')->nullable()->default(null);
            $table->string('ibu_foto_ktp')->nullable()->default(null);
            $table->text('ibu_alamat')->nullable()->default(null);

            // ayah
            $table->string('ayah_nama')->nullable()->default(null);
            $table->string('ayah_nik')->nullable()->default(null);
            $table->string('ayah_nik_jenis')->nullable()->default(null)->comment('No KTP, KTP Sementara');
            $table->string('ayah_jenis_kelamin')->nullable()->default(null);
            $table->string('ayah_tempat_lahir')->nullable()->default(null);
            $table->date('ayah_tanggal_lahir')->nullable()->default(null);
            $table->string('ayah_agama')->nullable()->default(null);
            $table->string('ayah_pendidikan')->nullable()->default(null);
            $table->string('ayah_pekerjaan')->nullable()->default(null);
            $table->string('ayah_status_kawin')->nullable()->default(null);
            $table->string('ayah_no_kk')->nullable()->default(null);
            $table->string('ayah_warga_negara')->nullable()->default(null);
            $table->string('ayah_negara_nama')->nullable()->default(null);
            $table->string('ayah_no_passport')->nullable()->default(null);
            $table->string('ayah_kitas_kitap')->nullable()->default(null);
            $table->string('ayah_foto_ktp')->nullable()->default(null);
            $table->text('ayah_alamat')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('surat_id')
                ->references('id')->on('surats')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('ibu_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('ayah_id')
                ->references('id')->on('penduduks')
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
        Schema::dropIfExists('surat_kelahirans');
    }
};
