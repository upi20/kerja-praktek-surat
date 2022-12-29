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
        Schema::create('surat_nikahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_id', false, true)->nullable()->default(null);
            $table->bigInteger('ibu_id', false, true)->nullable()->default(null);
            $table->bigInteger('ayah_id', false, true)->nullable()->default(null);
            $table->bigInteger('anak_id', false, true)->nullable()->default(null);
            $table->bigInteger('calon_id', false, true)->nullable()->default(null);

            $table->date('tanggal')->nullable()->default(null);
            $table->time('waktu')->nullable()->default(null);
            $table->text('tempat')->nullable()->default(null);
            $table->string('dengan_seorang')->nullable()->default(null);
            $table->string('calon_a')->nullable()->default(null);
            $table->string('calon_b')->nullable()->default(null);

            $table->string("ibu_nik")->nullable()->default(null);
            $table->string("ibu_nama")->nullable()->default(null);
            $table->string("ibu_nik_jenis")->nullable()->default(null)->comment("No KTP, KTP Sementara");
            $table->string("ibu_jenis_kelamin")->nullable()->default(null);
            $table->string("ibu_tempat_lahir")->nullable()->default(null);
            $table->date("ibu_tanggal_lahir")->nullable()->default(null);
            $table->string("ibu_agama")->nullable()->default(null);
            $table->string("ibu_pendidikan")->nullable()->default(null);
            $table->string("ibu_pekerjaan")->nullable()->default(null);
            $table->string("ibu_status_kawin")->nullable()->default(null);
            $table->string("ibu_no_kk")->nullable()->default(null);
            $table->string("ibu_warga_negara")->nullable()->default(null);
            $table->string("ibu_negara_nama")->nullable()->default(null);
            $table->string("ibu_no_passport")->nullable()->default(null);
            $table->string("ibu_kitas_kitap")->nullable()->default(null);
            $table->string("ibu_foto_ktp")->nullable()->default(null);
            $table->text("ibu_alamat")->nullable()->default(null);

            $table->string("ayah_nik")->nullable()->default(null);
            $table->string("ayah_nama")->nullable()->default(null);
            $table->string("ayah_nik_jenis")->nullable()->default(null)->comment("No KTP, KTP Sementara");
            $table->string("ayah_jenis_kelamin")->nullable()->default(null);
            $table->string("ayah_tempat_lahir")->nullable()->default(null);
            $table->date("ayah_tanggal_lahir")->nullable()->default(null);
            $table->string("ayah_agama")->nullable()->default(null);
            $table->string("ayah_pendidikan")->nullable()->default(null);
            $table->string("ayah_pekerjaan")->nullable()->default(null);
            $table->string("ayah_status_kawin")->nullable()->default(null);
            $table->string("ayah_no_kk")->nullable()->default(null);
            $table->string("ayah_warga_negara")->nullable()->default(null);
            $table->string("ayah_negara_nama")->nullable()->default(null);
            $table->string("ayah_no_passport")->nullable()->default(null);
            $table->string("ayah_kitas_kitap")->nullable()->default(null);
            $table->string("ayah_foto_ktp")->nullable()->default(null);
            $table->text("ayah_alamat")->nullable()->default(null);

            $table->string("anak_nik")->nullable()->default(null);
            $table->string("anak_nama")->nullable()->default(null);
            $table->string("anak_nik_jenis")->nullable()->default(null)->comment("No KTP, KTP Sementara");
            $table->string("anak_jenis_kelamin")->nullable()->default(null);
            $table->string("anak_tempat_lahir")->nullable()->default(null);
            $table->date("anak_tanggal_lahir")->nullable()->default(null);
            $table->string("anak_agama")->nullable()->default(null);
            $table->string("anak_pendidikan")->nullable()->default(null);
            $table->string("anak_pekerjaan")->nullable()->default(null);
            $table->string("anak_status_kawin")->nullable()->default(null);
            $table->string("anak_no_kk")->nullable()->default(null);
            $table->string("anak_warga_negara")->nullable()->default(null);
            $table->string("anak_negara_nama")->nullable()->default(null);
            $table->string("anak_no_passport")->nullable()->default(null);
            $table->string("anak_kitas_kitap")->nullable()->default(null);
            $table->string("anak_foto_ktp")->nullable()->default(null);
            $table->text("anak_alamat")->nullable()->default(null);

            $table->string("calon_nik")->nullable()->default(null);
            $table->string("calon_nama")->nullable()->default(null);
            $table->string("calon_nik_jenis")->nullable()->default(null)->comment("No KTP, KTP Sementara");
            $table->string("calon_jenis_kelamin")->nullable()->default(null);
            $table->string("calon_tempat_lahir")->nullable()->default(null);
            $table->date("calon_tanggal_lahir")->nullable()->default(null);
            $table->string("calon_agama")->nullable()->default(null);
            $table->string("calon_pendidikan")->nullable()->default(null);
            $table->string("calon_pekerjaan")->nullable()->default(null);
            $table->string("calon_status_kawin")->nullable()->default(null);
            $table->string("calon_no_kk")->nullable()->default(null);
            $table->string("calon_warga_negara")->nullable()->default(null);
            $table->string("calon_negara_nama")->nullable()->default(null);
            $table->string("calon_no_passport")->nullable()->default(null);
            $table->string("calon_kitas_kitap")->nullable()->default(null);
            $table->string("calon_foto_ktp")->nullable()->default(null);
            $table->text("calon_alamat")->nullable()->default(null);

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
            $table->foreign('anak_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('calon_id')
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
        Schema::dropIfExists('surat_nikahs');
    }
};
