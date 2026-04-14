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

        // PDF / Browsershot configuration for Docker/Production
        if (env('PUPPETEER_EXECUTABLE_PATH')) {
            \Spatie\LaravelPdf\Facades\Pdf::default()
                ->withBrowsershot(function (\Spatie\Browsershot\Browsershot $browsershot) {
                    $browsershot->setChromePath(env('PUPPETEER_EXECUTABLE_PATH'))
                        ->addChromiumArguments([
                            'no-sandbox',
                            'disable-setuid-sandbox',
                        ]);
                });
        }
    }
}
