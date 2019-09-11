<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcoesCorretivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_corretivas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255)->nullable();
            $table->string('descricao', 255)->nullable();
            $table->integer('ativo')->nullable();
            $table->string('tempo', 10)->nullable();
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
        Schema::dropIfExists('acoes_corretivas');
    }
}
