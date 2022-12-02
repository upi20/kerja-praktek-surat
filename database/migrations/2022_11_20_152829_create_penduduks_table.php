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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->string('nik')->nullable()->default(null);
            $table->string('nama')->nullable()->default(null);
            $table->string('jenis_kelamin')->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->string('tanggal_lahir')->nullable()->default(null);
            $table->string('agama')->nullable()->default(null);
            $table->string('pendidikan')->nullable()->default(null);
            $table->string('pekerjaan')->nullable()->default(null);
            $table->string('status_kawin')->nullable()->default(null);
            $table->string('no_kk')->nullable()->default(null);
            $table->string('hub_dgn_kk')->nullable()->default(null);
            $table->integer('hub_dgn_kk_urutan')->nullable()->default(null)->comment("Contoh kepala keluarga selalu no 1");
            $table->string('warga_negara')->nullable()->default(null);
            $table->string('negara_nama')->nullable()->default(null);
            $table->string('no_passport')->nullable()->default(null);
            $table->string('kitas_kitap')->nullable()->default(null);
            $table->string('foto_ktp')->nullable()->default(null);
            $table->text('alamat')->nullable()->default(null);
            $table->string('penduduk_ada')->nullable()->default('Tidak Ada');

            $table->foreign('rt_id')
                ->references('id')->on('rts')
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
        Schema::dropIfExists('penduduks');
    }
};
