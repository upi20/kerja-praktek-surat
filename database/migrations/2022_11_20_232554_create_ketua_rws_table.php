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
        Schema::create('ketua_rws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rw_id', false, true)->nullable()->default(null);
            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->foreign('rw_id')
                ->references('id')->on('rws')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('penduduk_id')
                ->references('id')->on('rws')
                ->cascadeOnDelete()
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
        Schema::dropIfExists('ketua_rws');
    }
};
