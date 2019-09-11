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
            $table->string('cnpj')->unique();
            $table->string('inscricao_estadual')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->integer('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('municipio')->unsigned();
            $table->integer('uf')->unsigned();
            $table->string('segmento', 50)->nullable();
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
