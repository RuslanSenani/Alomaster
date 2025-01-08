<?php

namespace App\Providers;

use App\Loggers\DatabaseLogger;
use App\LogRepo\LogManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LogManager::class, function ($app) {
            $logManager = new LogManager();

            $logManager->addLogger(new DatabaseLogger());


            return $logManager;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
