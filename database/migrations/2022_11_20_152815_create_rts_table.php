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
        Schema::create('rts', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->nullable()->default(null);
            $table->string('nama_daerah')->nullable()->default(null)->comment('Nama kampung atau yg lain');
            $table->bigInteger('rw_id', false, true)->nullable()->default(null);
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
        Schema::dropIfExists('rts');
    }
};
