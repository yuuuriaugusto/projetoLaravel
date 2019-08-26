<?php

namespace App\Tenant\Database;

use Illuminate\Support\Facades\DB;
use App\Empresas;

class DatabaseManager
{
    public function criarDatabase(Empresas $empresa)
    {
        return DB::statement("
            CREATE DATABASE {$empresa->db_database}
        ");
    }
}
