<?php

namespace App\Tenant;

use App\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{

    Public function setConexao(Empresas $empresa)
    {
        DB::purge('tenant');

        // config()->set('database.connections.tenant.host', $empresa->db_hostname);
        config()->set('database.connections.tenant.dominio', $empresa->dominio);
        config()->set('database.connections.tenant.database', $empresa->db_database);
        // config()->set('database.connections.tenant.username', $empresa->db_username);
        // config()->set('database.connections.tenant.password', $empresa->db_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

    public function dominioMain() {
        return request()->getHost() == config('tenant.dominio_main');
    }
}