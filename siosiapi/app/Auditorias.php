<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditorias extends Model
{
    protected $fillable =['id_processos','id_users', 'id_setors'];

    public function Auditorias(){
        return $this->belongsToMany(Auditorias::class, 'id_users', 'fichas', 'fichas_temperaturas');
    }
}
