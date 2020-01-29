<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrevisaoAbates extends Model
{
    protected $fillable =['data', 'data_previsao_abate', 'lote', 'produtor', 'uf', 'municipio', 'numero_animais', 'gta', 'placa_caminhao', 'sexo_animal', 'idade_animal', 'ordem_descarga'];
}
