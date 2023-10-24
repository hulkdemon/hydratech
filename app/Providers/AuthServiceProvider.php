<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
            // Compuerta para el rol Administrador.
            Gate::define('Administrador', function ($user) {
            // Definir si el  rol es Administrador.
            return $user->rol->tipo === 'Administrador';
        });

            //Compuerta para el rol Cajero.
            Gate::define('Cajero', function ($user) {
            // Definir si el  rol es Cajero.
            return $user->rol->tipo === 'Cajero'; 

            //--------------------Definición de ruta para accesos en el Web.php}

            //Ruta para ingresar a las funciones de roles como administrador
            Gate::define('administrar-roles', function ($user) {
                return $user->rol->tipo === 'Administrador';
            });
    
        });
    }
}
