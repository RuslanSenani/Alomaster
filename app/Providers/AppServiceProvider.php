<?php

namespace App\Providers;

use App\Contracts\IAlert;
use App\Contracts\IBaseRepository;
use App\Contracts\ILoggerRepository;
use App\Contracts\IRankableRepository;
use App\Contracts\IStatusRepository;
use App\Repositories\BaseRepository;
use App\Repositories\DatabaseLoggerRepository;
use App\Repositories\RankableRepository;
use App\Repositories\StatusRepository;
use App\Services\Back\AlertServices;
use App\Services\Back\RankServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(ILoggerRepository::class, DatabaseLoggerRepository::class);
        $this->app->bind(IAlert::class, AlertServices::class);

        $this->app->bind(IRankableRepository::class, RankableRepository::class);
        $this->app->bind(IStatusRepository::class, StatusRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
