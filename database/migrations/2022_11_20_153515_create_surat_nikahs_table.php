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

            foreach (['ibu', 'ayah', 'anak', 'calon'] as $v) {
                $table->string("{$v}_nik")->nullable()->default(null);
                $table->string("{$v}_nama")->nullable()->default(null);
                $table->string("{$v}_nik_jenis")->nullable()->default(null)->comment("No KTP, KTP Sementara");
                $table->string("{$v}_jenis_kelamin")->nullable()->default(null);
                $table->string("{$v}_tempat_lahir")->nullable()->default(null);
                $table->date("{$v}_tanggal_lahir")->nullable()->default(null);
                $table->string("{$v}_agama")->nullable()->default(null);
                $table->string("{$v}_pendidikan")->nullable()->default(null);
                $table->string("{$v}_pekerjaan")->nullable()->default(null);
                $table->string("{$v}_status_kawin")->nullable()->default(null);
                $table->string("{$v}_no_kk")->nullable()->default(null);
                $table->string("{$v}_warga_negara")->nullable()->default(null);
                $table->string("{$v}_negara_nama")->nullable()->default(null);
                $table->string("{$v}_no_passport")->nullable()->default(null);
                $table->string("{$v}_kitas_kitap")->nullable()->default(null);
                $table->string("{$v}_foto_ktp")->nullable()->default(null);
            }

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
