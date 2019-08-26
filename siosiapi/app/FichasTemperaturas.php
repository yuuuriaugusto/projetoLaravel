<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichasTemperaturas extends Model
{
    protected $fillable = ['temperatura_painel', 'temperatura_aferida', 'reaudita', 'conforme', 'id_itens', 'id_setors', 'id_auditorias', 'created_at', 'updated_at'];

    public function FichasTemperaturas(){
        return $this->belongsToMany(FichasTemperaturas::class, 'naosconformidades_itens');
    }
}