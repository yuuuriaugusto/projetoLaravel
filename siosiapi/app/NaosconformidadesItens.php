<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaosconformidadesItens extends Model
{
    protected $fillable  = ['produtor','id_fichas','id_fichastemperaturas','id_naoconformidades','id_funcionarios','id_acaocorretivaitens', 'prazo','observacoes','statusC','statusNC','id_interdicao'];
}
