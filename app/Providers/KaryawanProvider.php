<?php

namespace App\Providers;

use App\Services\Impl\KaryawanServiceImpl;
use App\Services\KaryawanService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class KaryawanProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        KaryawanService::class => KaryawanServiceImpl::class
    ];

    public function provides()
    {
        return [KaryawanService::class];
    }


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
