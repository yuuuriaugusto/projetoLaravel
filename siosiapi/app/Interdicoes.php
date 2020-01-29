<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interdicoes extends Model
{
    protected $fillable =['nome'];
   
    public function Interdicoes(){
        return $this->belongsToMany(Interdicoes::class, 'naosconformidades_itens');
    }
}
