<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social');
            $table->string('fantasia')->nullable();
            $table->string('cnpj', 18);
            $table->string('inscricao_estadual', 18)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('endereco')->nullable();
            $table->integer('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('municipio')->unsigned()->nullable();
            $table->integer('uf')->unsigned()->nullable();
            $table->integer('pais')->unsigned()->nullable();
            $table->integer('segmento')->nullable();
            $table->integer('fiscalizacao')->unsigned()->nullable();
            $table->string('dominio')->nullable();
            $table->string('db_database')->unique();
            $table->integer('ativo')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
