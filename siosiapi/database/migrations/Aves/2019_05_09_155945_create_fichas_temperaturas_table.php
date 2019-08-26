<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_temperaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('temperatura_painel')->nullable();
            $table->double('temperatura_aferida')->nullable();
            $table->integer('reaudita');
            $table->integer('conforme');
            $table->integer('id_itens')->unsigned();
            $table->integer('id_auditorias')->unsigned();
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
        Schema::dropIfExists('fichas_temperaturas');
    }
}
