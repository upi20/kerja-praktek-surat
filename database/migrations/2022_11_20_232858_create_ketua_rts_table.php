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
        Schema::create('ketua_rts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->foreign('rt_id')
                ->references('id')->on('rts')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('penduduk_id')
                ->references('id')->on('rts')
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
        Schema::dropIfExists('ketua_rts');
    }
};
