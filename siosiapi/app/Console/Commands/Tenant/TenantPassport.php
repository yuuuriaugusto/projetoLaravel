<?php

namespace App\Console\Commands\Tenant;

use Illuminate\Console\Command;
use App\Console\Commands\Tenant\TenantMigrationAves;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Tenant\ManagerTenant;
use App\Empresas;

class TenantPassport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:passport {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando para criação do passport';

    private $tenant;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();

        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // shell_exec('php artisan passport:install');
        // Artisan::call('passport:install');
        if ($id = $this->argument('id')){
            $empresa = Empresas::find($id);
            // $empresa = DB::table('empresas')->where('id', $id);

            if ($empresa){
                $this->exeCommand($empresa);
            }

            return;
        }

        $empresas = Empresas::all();

        foreach ($empresas as $empresa) {
            $this->exeCommand($empresa);
        }
    }
    public function exeCommand(Empresas $empresa)
    {

        // $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $this->tenant->setConexao($empresa);

        $this->info("Conectando empresa {$empresa->fantasia}");

        // Artisan::call('migrate', [
        //     '--force' => true,
        //     '--path'  => '/database/migrations/Aves',
        // ]);

        // Artisan::call('migrate', [
        //     '--force' => true,
        //     '--path'  => '/vendor/laravel/passport/database/migrations',
        // ]);
        // Artisan::call('db:seed');

        Artisan::call('passport:install');
       
        $this->info("Fim da conexão com empresa {$empresa->fantasia}");
        $this->info('-------------------------------------------------');
        
    }
}