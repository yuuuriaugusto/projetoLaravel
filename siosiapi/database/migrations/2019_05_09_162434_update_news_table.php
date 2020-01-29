<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acoes_naoconformidades', function (Blueprint $table) {
            $table->foreign('id_acoescorretivas')->references('id')->on('acoes_corretivas');
            $table->foreign('id_naoconformidade')->references('id')->on('naos_conformidades');
        });
        Schema::table('nc_itens', function (Blueprint $table){
            $table->foreign('id_itens')->references('id')->on('itens');
            $table->foreign('id_ncitens')->references('id')->on('naos_conformidades');
        });
        Schema::table('papels_users', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_papels')->references('id')->on('papels');
        });
        Schema::table('permissoes_users', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_permissoes')->references('id')->on('permissoes');
        });
        Schema::table('processos_setors', function (Blueprint $table){
            $table->foreign('processos_id')->references('id')->on('processos');
            $table->foreign('setors_id')->references('id')->on('setors');
        });
        
        Schema::table('auditorias', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_processos')->references('id')->on('processos');
            $table->foreign('id_setors')->references('id')->on('setors');
        });
        Schema::table('autorizacaos', function (Blueprint $table){
            $table->foreign('id_papels')->references('id')->on('papels');
            $table->foreign('id_setors')->references('id')->on('setors');
        });
        Schema::table('fichas', function (Blueprint $table){
            $table->foreign('id_itens')->references('id')->on('itens');
            $table->foreign('id_auditorias')->references('id')->on('auditorias');
        });
        Schema::table('fichas_temperaturas', function (Blueprint $table){
            $table->foreign('id_itens')->references('id')->on('itens_temperaturas');
            $table->foreign('id_auditorias')->references('id')->on('auditorias');
        });
        Schema::table('itens', function (Blueprint $table){
            $table->foreign('processos_setor_id')->references('id')->on('processos_setors');
        });
        Schema::table('itens_temperaturas', function (Blueprint $table){
            $table->foreign('processo_setor_id')->references('id')->on('processos_setors');
        });
        Schema::table('naosconformidades_itens', function (Blueprint $table){
            $table->foreign('id_naoconformidades')->references('id')->on('naos_conformidades');
            $table->foreign('id_fichas')->references('id')->on('fichas');
            $table->foreign('id_acaocorretivaitens')->references('id')->on('acoes_corretivas');
            $table->foreign('id_funcionarios')->references('id')->on('funcionarios');
            $table->foreign('id_fichastemperaturas')->references('id')->on('fichas_temperaturas');
            $table->foreign('id_interdicao')->references('id')->on('interdicoes');
        });
        Schema::table('nc_itens_temps', function (Blueprint $table){
            $table->foreign('id_itens_temperatura')->references('id')->on('itens_temperaturas');
            $table->foreign('id_ncitens')->references('id')->on('naos_conformidades');
        });
        Schema::table('estados', function (Blueprint $table){
            $table->foreign('id_pais')->references('id')->on('paises');
        });
        Schema::table('cidades', function (Blueprint $table){
            $table->foreign('id_estado')->references('id')->on('estados');
        });
        Schema::table('empresas', function (Blueprint $table){
            $table->foreign('uf')->references('id')->on('estados');
            $table->foreign('municipio')->references('id')->on('cidades');
            $table->foreign('pais')->references('id')->on('paises');
            $table->foreign('segmento')->references('id')->on('segmento');
            $table->foreign('fiscalizacao')->references('id')->on('fiscalizacao');
        });
        Schema::table('previsao_abates', function (Blueprint $table){
            $table->foreign('produtor')->references('id')->on('users');
            $table->foreign('uf')->references('id')->on('estados');
            $table->foreign('municipio')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
