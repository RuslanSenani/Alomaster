<?php

namespace App\Providers;

use App\Contracts\ICoursesRepository;
use App\Repositories\CoursesRepository;
use Illuminate\Support\ServiceProvider;

class CoursesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICoursesRepository::class, CoursesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
