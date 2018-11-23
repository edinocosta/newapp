<?php

namespace App\Providers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Cliente;
use Illuminate\Support\ServiceProvider;

class LaravelLoggerProxy {
    public function log( $msg ) {
        Log::info($msg);
    }
}

class AppServiceProvider extends ServiceProvider
{
    /**
     * Inicia qualquer serviço da aplicação.
     * retirado direto da documentação
     * 
     * @return void
     */
    public function boot()
    {
        $pusher = $this->app->make('pusher');
        $pusher->set_logger( new LaravelLoggerProxy() );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}