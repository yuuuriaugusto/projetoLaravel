<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papels extends Model
{
    protected $fillable = ['nome'];

    public function Papels(){
        return $this->belongsToMany(Papels::class, 'autorizacaos', 'papels_users');
    }
}
