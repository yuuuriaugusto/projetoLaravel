<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = ['razao_social', 'fantasia', 'cnpj', 'inscricao_estadual', 'cep', 'endereco', 'numero', 'bairro', 'municipio', 'uf', 'pais', 'segmento', 'fiscalizacao', 'dominio', 'db_database', 'ativo', 'logo'];
}
