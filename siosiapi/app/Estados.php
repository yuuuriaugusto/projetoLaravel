<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $fillable = ['nome', 'uf', 'id_pais'];

    public function Estados(){
        return $this->BelongsToMany(Estados::class, 'cidades', 'empresas');
    }
}
