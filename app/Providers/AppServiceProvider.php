<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

use Livewire\Livewire;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\EditUser;

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
        /* $this->registerPolicies(); */

        // Definir un gate para el rol de administrador
        /* Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        }); */

        Livewire::component('create-user', CreateUser::class);
        Livewire::component('edit-user', EditUser::class);
    }

    /* protected $policies = [
        User::class => UserPolicy::class,
    ]; */
    
}
