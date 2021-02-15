<?php

namespace App\Providers;

use App\Contracts\InternetArchive;
use App\Contracts\LibriVox;
use App\Services\InternetArchiveService;
use App\Services\LibriVoxService;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(InternetArchive::class, InternetArchiveService::class);
        $this->app->bind(LibriVox::class, LibriVoxService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
