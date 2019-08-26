<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\InstalandoPassaport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class CriarPassaport
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
     * @param  InstalandoPassaport  $event
     * @return void
     */
    public function handle(InstalandoPassaport $event)
    {
        $empresa = $event->empresa();

        Artisan::call('tenant:passport', [
            'id' => $empresa->id,
        ]);
    }
}
