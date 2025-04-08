<?php

namespace App\Providers;

use App\Services\Impl\KualifikasiTeoriServiceImpl;
use App\Services\KualifikasiTeoriService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class KualifikasiTeoriProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        KualifikasiTeoriService::class => KualifikasiTeoriServiceImpl::class
    ];

    public function provides()
    {
        return [KualifikasiTeoriService::class];
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
