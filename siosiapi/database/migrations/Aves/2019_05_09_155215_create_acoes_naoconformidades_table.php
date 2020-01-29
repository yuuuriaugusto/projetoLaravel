<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcoesNaoconformidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_naoconformidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_acoescorretivas')->unsigned()->nullable();
            $table->integer('id_naoconformidade')->unsigned()->nullable();
            $table->timestamps();

            // $table->foreign('id_acoescorretivas')->references('id')->on('acoes_corretivas');
            // $table->foreign('id_naoconformidade')->references('id')->on('naos_conformidades');
        });
        // Schema::table('acoes_naoconformidades', function (Blueprint $table) {
        //     $table->integer('id_acoescorretivas');
        //     $table->integer('id_naoconformidade');

        //     $table->foreign('id_acoescorretivas')->references('id')->on('acoes_corretivas');
        //     $table->foreign('id_naoconformidade')->references('id')->on('naos_conformidades');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acoes_naoconformidades');
    }
}
