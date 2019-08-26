<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setors extends Model
{
    protected $fillable = ['nome','ativo'];

    public function Setors(){
        return $this->belongsToMany(Setors::class, 'autorizacaos', 'processos_setors', 'auditorias');
    }
}
