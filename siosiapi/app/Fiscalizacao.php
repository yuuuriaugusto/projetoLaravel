<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiscalizacao extends Model
{
    protected $fillable = ['id', 'nome',];
    public function Fiscalização(){
        return $this->belongsToMany(Fiscalizacao::class, 'empresas');
    }
}
