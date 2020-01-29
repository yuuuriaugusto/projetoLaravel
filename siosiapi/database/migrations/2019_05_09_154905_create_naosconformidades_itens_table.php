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
            $table->string('observacoes')->nullable();
            $table->integer('statusC')->nullable();
            $table->integer('statusNC')->nullable();
            $table->string('prazo', 10)->nullable();
            $table->integer('id_naoconformidades')->unsigned()->nullable();
            $table->integer('id_fichas')->unsigned()->nullable();
            $table->integer('id_funcionarios')->unsigned()->nullable();
            $table->integer('id_acaocorretivaitens')->unsigned()->nullable();
            $table->integer('id_fichastemperaturas')->unsigned()->nullable();
            $table->integer('id_interdicao')->unsigned()->nullable();
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
