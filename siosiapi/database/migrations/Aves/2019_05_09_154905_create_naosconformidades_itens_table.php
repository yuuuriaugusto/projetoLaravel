<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNaosconformidadesItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('naosconformidades_itens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observacoes');
            $table->integer('statusC');
            $table->integer('statusNC');
            $table->timestamp('prazo');
            $table->integer('id_naoconformidades')->unsigned();
            $table->integer('id_fichas')->unsigned();
            $table->integer('id_funcionarios')->unsigned();
            $table->integer('id_acaocorretivaitens')->unsigned();
            $table->integer('id_fichastemperaturas')->unsigned();
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
        Schema::dropIfExists('naosconformidades_itens');
    }
}
