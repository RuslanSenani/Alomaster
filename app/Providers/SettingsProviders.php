<?php

namespace App\Providers;

use App\Contracts\ISettingsRepository;
use App\Repositories\SettingsRepository;
use Illuminate\Support\ServiceProvider;

class SettingsProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ISettingsRepository::class, SettingsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
