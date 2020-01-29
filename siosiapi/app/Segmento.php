<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    protected $fillable = ['id','nome'];
    public function Segmento(){
        return $this->belongsToMany(Segmento::class, 'empresas');
    }
}
