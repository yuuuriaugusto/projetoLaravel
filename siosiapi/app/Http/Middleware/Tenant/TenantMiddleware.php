<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use App\Empresas;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        $manager = app(ManagerTenant::class);

        if ($manager->dominioMain())
            return $next($request);

        $empresa = $this->getEmpresa($request->getHost());
        
        
        if (!$empresa && $request->url()) {
            return response()->json('Error tenant 404');
        }
        else if(!$manager->dominioMain()){
            $manager->setConexao($empresa);
        }
        


        return $next($request);
    }

    public function getEmpresa($host)
    {
        return Empresas::where('dominio', $host)->first();
    }
}
