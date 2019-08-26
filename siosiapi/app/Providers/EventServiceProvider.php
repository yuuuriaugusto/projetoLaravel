<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Tenant\CriandoEmpresa' => [
            'App\Listeners\Tenant\CriarBaseEmpresa',
        ],
        'App\Events\Tenant\CriandoDatabase' =>[
            'App\Listeners\Tenant\GerarMigrations',
        ],
        'App\Events\Tenant\InstalandoPassaport' =>[
            'App\Listeners\Tenant\CriarPassaport',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
