<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerangkatTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_perangkat')->nullable();
            $table->string('uraian_perangkat')->nullable();
            $table->integer('stok_perangkat')->nullable();
            $table->date('tahun_pengadaan_perangkat')->nullable();
            $table->string('type_perangkat')->nullable();
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
        Schema::drop('perangkat');
    }
}
