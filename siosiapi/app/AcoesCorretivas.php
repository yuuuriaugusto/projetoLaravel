<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcoesCorretivas extends Model
{
    protected $fillable = ['nome','descricao','ativo', 'tempo', 'preventiva'];

    public function AcoesCorretivas(){
        return $this->belongsToMany(AcoesCorretivas::class, 'acoes_naosconformidades', 'naosconformidades_itens');
    }
}
