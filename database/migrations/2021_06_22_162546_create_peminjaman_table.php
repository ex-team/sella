<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeminjamanTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perangkat_id')->unsigned()->nullable();
            $table->date('tgl_peminjaman')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->string('keperluan')->nullable();
            $table->timestamps();
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreign('perangkat_id')->references('id')->on('perangkat')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign('perangkat_id_foreign');
            $table->dropIndex('perangkat_id_foreign');
            $table->dropColumn('perangkat_id');
        });
        Schema::drop('peminjaman');
    }
}
