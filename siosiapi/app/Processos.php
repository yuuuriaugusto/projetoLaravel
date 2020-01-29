<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Processos extends Model
{

    protected $fillable = ['nome','documento','ativo', 'produtor'];

    public function Processos(){
        return $this->belongsToMany(Processos::class, 'processos_setors', 'auditorias');
    }    
}
