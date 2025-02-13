<?php

namespace App\Providers;

use App\Contracts\IBrandsRepository;
use App\Repositories\BrandsRepository;
use Illuminate\Support\ServiceProvider;

class BrandsProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IBrandsRepository::class, BrandsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
