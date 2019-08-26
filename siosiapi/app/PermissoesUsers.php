<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissoesUsers extends Model
{
    protected $fillable =['id_users', 'id_permissoes'];
}
