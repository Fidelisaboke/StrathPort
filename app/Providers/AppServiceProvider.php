<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;

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
        Password::defaults(function(){
            return Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        Gate::define('admin', function($user){
            return $user->hasRole('admin');
        });
        Gate::define('student', function($user){
            return $user->hasRole('student');
        });
        Gate::define('staff', function($user){
            return $user->hasRole('staff');
        });
        Gate::define('carpool_driver', function($user){
            return $user->hasRole('carpool_driver');
        });
    }
}
