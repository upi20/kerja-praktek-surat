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
        Schema::create('surat_keterangan_jenis', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
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
        Schema::dropIfExists('surat_keterangan_jenis');
    }
};
