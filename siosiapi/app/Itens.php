<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    protected $fillable = ['nome','ativo','processos_setor_id', 'ajuda'];

    public function Itens(){
        return $this->belongsToMany(Itens::class, 'fichas', 'nc_itens', 'itens');
    }
}
