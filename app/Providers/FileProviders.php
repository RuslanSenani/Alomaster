<?php

namespace App\Providers;

use App\Contracts\IFileRepository;
use App\Repositories\FileRepository;
use Illuminate\Support\ServiceProvider;

class FileProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IFileRepository::class, FileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
