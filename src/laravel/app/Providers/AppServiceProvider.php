<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Providers;

use App\Providers\AppServiceProvider\AppServicePackageProviderUtil;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private readonly AppServicePackageProviderUtil $appServicePackageProviderUtil;

    public function __construct(
        Application $app,
    ) {
        parent::__construct($app);

        $this->appServicePackageProviderUtil = new AppServicePackageProviderUtil();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('RUN_ON', 'official') === 'mock') {
            $this->appServicePackageProviderUtil->registerForMock($this->app);
        } else {
            $this->appServicePackageProviderUtil->registerForOfficial($this->app);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
