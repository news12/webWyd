<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contract\CharacterRepositoryInterface::class,
        \App\Repositories\Eloquent\CharacterRepository::class);

        $this->app->bind(\App\Repositories\Contract\StorageRepositoryInterface::class,
        \App\Repositories\Eloquent\StorageRepository::class);

        $this->app->bind(\App\Repositories\Contract\SaleRepositoryInterface::class,
        \App\Repositories\Eloquent\SaleRepository::class);

        $this->app->bind(\App\Repositories\Contract\NewsRepositoryInterface::class,
        \App\Repositories\Eloquent\NewsRepository::class);

        $this->app->bind(\App\Repositories\Contract\NeilRepositoryInterface::class,
        \App\Repositories\Eloquent\NeilRepository::class);

        $this->app->bind(\App\Repositories\Contract\GuildRepositoryInterface::class,
        \App\Repositories\Eloquent\GuildRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
