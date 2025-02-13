<?php

namespace App\Providers;

use App\Contracts\IReferencesRepository;
use App\Repositories\ReferencesRepository;
use Illuminate\Support\ServiceProvider;

class ReferencesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IReferencesRepository::class, ReferencesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
