<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensTemperaturas extends Model
{
    protected $fillable = ['processo_setor_id', 'temperatura_minima', 'temperatura_maxima', 'nome', 'ativo', 'ajuda'];
    
    
    public function ItensTemperaturas(){
        return $this->belongsToMany(ItensTemperaturas::class, 'fichas_temperaturas', 'itens_temperaturas');
    }
}