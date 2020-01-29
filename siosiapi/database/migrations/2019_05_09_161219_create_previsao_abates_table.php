<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevisaoAbatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsao_abates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data')->nullable();
            $table->date('data_previsao_abate')->nullable();
            $table->integer('lote')->nullable();
            $table->integer('produtor')->unsigned()->nullable();
            $table->integer('uf')->unsigned()->nullable();
            $table->integer('municipio')->unsigned()->nullable();
            $table->integer('numero_animais')->nullable();
            $table->string('gta', 9)->nullable();
            $table->string('placa_caminhao', 8)->nullable();
            $table->string('sexo_animal', 10)->nullable();
            $table->integer('idade_animal')->nullable();
            $table->integer('ordem_descarga')->nullable();
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
        Schema::dropIfExists('previsao_abate');
    }
}
