<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('Admin-permits', function (User $user){
            return $user->rol === 'admin';
        });

        Gate::define('Cashier-permits', function (User $user){
            return in_array($user->rol, ['admin', 'cajero']);
        });
    }
}
