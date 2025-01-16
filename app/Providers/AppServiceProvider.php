<?php

namespace App\Providers;

use App\Contracts\ILoggerRepository;
use App\Repositories\DatabaseLoggerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(ILoggerRepository::class, DatabaseLoggerRepository::class);

//        foreach (glob(app_path('Contracts') . '/*.php') as $file) {
//            $interface = 'App\\Contracts\\' . basename($file, '.php');
//            $implementation = 'App\\Repositories\\' . basename($file, 'Interface.php');
//
//            if (class_exists($implementation)) {
//                $this->app->bind($interface, $implementation);
//            }
//
//        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
