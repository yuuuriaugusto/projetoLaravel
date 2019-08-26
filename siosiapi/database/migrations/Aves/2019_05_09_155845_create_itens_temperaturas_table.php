<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_temperaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->double('temperatura_maxima')->nullable();
            $table->double('temperatura_minima')->nullable();
            $table->integer('ativo');
            $table->integer('processo_setor_id')->unsigned();
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
        Schema::dropIfExists('itens_temperaturas');
    }
}
