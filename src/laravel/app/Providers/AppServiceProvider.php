<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('RUN_ON', 'official') === 'mock') {
            $this->registerForMock();
        } else {
            $this->registerForOfficial();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerForOfficial(): void
    {
        $this->app->bind(
            \Packages\UseCases\User\Create\CreateUserUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\User\CreateUserUseCase::class,
        );


        $this->app->bind(
            abstract: \Packages\Domains\User\UserRepositoryInterface::class,
            concrete: \App\Repositories\User\UserRepository::class,
        );
    }

    private function registerForMock(): void
    {
        $this->app->bind(
            \Packages\UseCases\User\Create\CreateUserUseCaseInterface::class,
            \Packages\Interactors\Mock\Auth\User\CreateUserUseCaseMock::class,
        );
    }
}
