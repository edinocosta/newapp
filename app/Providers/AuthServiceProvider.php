<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Auditoria' => 'App\Policies\AuditoriaPolicy',
        'App\Cliente' => 'App\Policies\ClientePolicy',
        'App\Compartimento' => 'App\Policies\CompartPolicy',
        'App\Evento' => 'App\Policies\EventoPolicy',
        'App\Propriedade' => 'App\Policies\PropriedadePolicy',
        'App\Visita' => 'App\Policies\VisitaPolicy',
        'App\Equipamento' => 'App\Policies\EquipamentoPolicy'

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
