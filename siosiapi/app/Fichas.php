<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Fichas extends Model
{
    protected $fillable = ['id_itens','id_auditorias','conforme', 'reaudita', 'naosconformidades_itens'];
}







