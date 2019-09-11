<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $fillable = ['nome', 'sigla'];

    public function Paises(){
        return $this->belongsToMany(Paises::class, 'estados');
    }
}
