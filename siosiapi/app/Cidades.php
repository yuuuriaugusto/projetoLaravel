<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $fillable = ['nome', 'id_estado'];

    public function Cidades(){
        $this->BelongsToMany(Cidades::class, 'empresas');
    }
}
