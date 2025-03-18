<?php

namespace App\Providers;

use App\Contracts\IContactRepository;
use App\Repositories\ContactRepository;
use Illuminate\Support\ServiceProvider;

class ContactProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(IContactRepository::class, ContactRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
