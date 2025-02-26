<?php

namespace App\Providers;

use App\Contracts\IServicesRepository;
use App\Repositories\ServicesRepository;
use Illuminate\Support\ServiceProvider;

class ServicesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IServicesRepository::class,ServicesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
