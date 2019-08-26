<?php

namespace App\Console\Commands\Tenant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use App\Tenant\ManagerTenant;
use App\Empresas;
// use Laravel\Passport\Passport;
// use Laravel\Passport\Console\InstallCommand;
// use Laravel\Passport\Console\ClientCommand;
// use Laravel\Passport\Console\KeysCommand;
// use Laravel\Passport\PassportServiceProvider;
// use Laravel\Passport\Console;
// use App\Events\Tenant\InstalandoPassaport;


class TenantMigrationAves extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrationAves {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando de migração estrutura para Aves';

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
        if ($id = $this->argument('id')){
            $empresa = Empresas::find($id);

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
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $this->tenant->setConexao($empresa);

        $this->info("Conectando empresa {$empresa->fantasia}");

        Artisan::call('migrate', [
            '--force' => true,
            '--path'  => '/database/migrations/Aves', 
        ]);
        Artisan::call('migrate', [
            '--force' => true,
            '--path'  => '/vendor/laravel/passport/database/migrations',
        ]);
        Artisan::call('db:seed');
        
        // Artisan::call('tenant:passport', [
        //     'id'      => $empresa->id,
        // ]);
        // $id = $empresa->id;
        //$saida = shell_exec('php artisan tenant:passport {$id}');
        // $saida = `php artisan tenant:passport 'id'=> {$empresa->id}`;

        // $command = 'php artisan tenant:passport ' . ['id' => $empresa->id] .'';
        // shell_exec($command);
        
        // $this->info($command);
        $this->info("Fim da conexão com empresa {$empresa->fantasia}");
        $this->info('-------------------------------------------------');
    }
    
}
