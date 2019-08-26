<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $fillable =['nome','ativo','cpf'];

    public function Funcinarios(){
        return $this->belongsToMany(Funcionarios::class, 'naosconformidades_itens');
    }
}
