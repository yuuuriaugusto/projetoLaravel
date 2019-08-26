<?php

namespace App\Listeners\Tenant;

use Illuminate\Support\Facades\Artisan;
use App\Events\Tenant\CriandoDatabase;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GerarMigrations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CriandoDatabase  $event
     * @return void
     */
    public function handle(CriandoDatabase $event)
    {

        $empresa = $event->empresa();

        Artisan::call('tenant:migrationAves', [
            'id' => $empresa->id,
        ]);

        
    }
}
