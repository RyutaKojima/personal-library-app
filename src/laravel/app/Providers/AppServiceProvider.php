<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
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
            $this->registerForOfficial($this->app);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerForOfficial(Application $app): void
    {
        $this->registerForOfficialUseCases($app);
        $this->registerForOfficialRepositories($app);
    }

    private function registerForOfficialUseCases(Application $app): void
    {
        $app->bind(
            \Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Authenticate\AuthenticateUseCase::class,
        );

        $app->bind(
            \Packages\UseCases\Auth\Login\LoginUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Login\LoginUseCase::class,
        );

        $app->bind(
            \Packages\UseCases\Auth\Logout\LogoutUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Logout\LogoutUseCase::class,
        );

        $app->bind(
            \Packages\UseCases\User\Create\CreateUserUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\User\CreateUserUseCase::class,
        );
    }

    private function registerForOfficialRepositories(Application $app): void
    {
        $app->bind(
            abstract: \Packages\Domains\Auth\AuthTokenRepositoryInterface::class,
            concrete: \App\Repositories\Auth\AuthTokenRepository::class,
        );

        $app->bind(
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
