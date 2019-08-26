<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaosConformidades extends Model
{
    protected $fillable = ["descricao", "ativo","nome"];

    public function NaosConformidades(){
        return $this->belongsToMany(NaosConformidades::class, 'acoes_naosconformidades', 'nc_itens', 'naosconformidades_itens');
    }    
}
