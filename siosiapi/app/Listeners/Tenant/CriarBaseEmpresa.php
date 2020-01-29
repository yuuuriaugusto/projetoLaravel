<?php

namespace App\Listeners\Tenant;

use App\Tenant\Database\DatabaseManager;
use App\Events\Tenant\CriandoDatabase;
use App\Events\Tenant\CriandoEmpresa;
use App\Events\Tenant\InstalandoPassaport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CriarBaseEmpresa
{

    private $database;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     *
     * @param  CriandoEmpresa  $event
     * @return void
     */
    public function handle(CriandoEmpresa $event)
    {
        $empresa = $event->empresa();

        if (!$this->database->criarDatabase($empresa)) {
            throw new \Exception('erro ao criar database');
        }

        // run migration
        event(new CriandoDatabase($empresa));
    }
}
