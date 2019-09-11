<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = ['razao_social', 'fantasia', 'cnpj', 'inscricao_estadual', 'cep', 'endereco', 'numero', 'bairro', 'municipio', 'uf', 'segmento', 'dominio', 'db_database', 'logo'];
}
