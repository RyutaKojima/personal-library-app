<?php

declare(strict_types=1);

namespace App\Providers\AppServiceProvider;

use Illuminate\Contracts\Foundation\Application;

final class AppServicePackageProviderUtil
{
    private const USE_CASE_BIND_LIST = [
        [
            \Packages\UseCases\User\Create\CreateUserUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\User\CreateUserUseCase::class,
            \Packages\Interactors\Mock\Auth\User\CreateUserUseCaseMock::class,
        ],
        [
            \Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Authenticate\AuthenticateUseCase::class,
            '',
        ],
        [
            \Packages\UseCases\Auth\Login\LoginUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Login\LoginUseCase::class,
            '',
        ],
        [
            \Packages\UseCases\Auth\Logout\LogoutUseCaseInterface::class,
            \Packages\Interactors\Official\Auth\Logout\LogoutUseCase::class,
            '',
        ],
        [
            \Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface::class,
            \Packages\Interactors\Official\Library\CreateLibrary\CreateLibraryUseCase::class,
            \Packages\Interactors\Mock\Library\CreateLibrary\CreateLibraryUseCaseMock::class,
        ],
        [
            \Packages\UseCases\Library\Join\JoinLibraryUseCaseInterface::class,
            \Packages\Interactors\Official\Library\Join\JoinLibraryUseCase::class,
            '',
        ],
        [
            \Packages\UseCases\Book\Register\RegisterBookUseCaseInterface::class,
            \Packages\Interactors\Official\Book\RegisterBook\RegisterBookUseCase::class,
            '',
        ],
    ];

    private const BIND_REPOSITORIES = [
        [
            \Packages\Domains\Auth\AuthTokenRepositoryInterface::class,
            \App\Repositories\Auth\AuthTokenRepository::class,
            '',
        ],
        [
            \Packages\Domains\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
            '',
        ],
        [
            \Packages\Domains\Library\LibraryRepositoryInterface::class,
            \App\Repositories\Library\LibraryRepository::class,
            \Packages\Domains\Library\LibraryRepositoryMock::class,
        ],
        [
            \Packages\Domains\Book\BookRepositoryInterface::class,
            \App\Repositories\Book\BookRepository::class,
            '',
        ],
    ];

    public function registerForOfficial(Application $app): void
    {
        $this->bindDefinitionsOfficial($app, self::USE_CASE_BIND_LIST);
        $this->bindDefinitionsOfficial($app, self::BIND_REPOSITORIES);
    }

    /**
     * @param Application $app
     * @param array<int, string[]> $bindList
     * @return void
     */
    private function bindDefinitionsOfficial(Application $app, array $bindList): void
    {
        foreach ($bindList as $bindParam) {
            $bindDefinition = new BindDefinition(...$bindParam);

            if (empty($bindDefinition->interface)) {
                continue;
            }
            if (empty($bindDefinition->officialInteractor)) {
                continue;
            }

            $app->bind(
                abstract: $bindDefinition->interface,
                concrete: $bindDefinition->officialInteractor,
            );
        }
    }

    public function registerForMock(Application $app): void
    {
        $this->bindDefinitionsMock($app, self::USE_CASE_BIND_LIST);
        $this->bindDefinitionsMock($app, self::BIND_REPOSITORIES);
    }

    /**
     * @param Application $app
     * @param array<int, string[]> $bindList
     * @return void
     */
    private function bindDefinitionsMock(Application $app, array $bindList): void
    {
        foreach ($bindList as $bindParam) {
            $bindDefinition = new BindDefinition(...$bindParam);

            if (empty($bindDefinition->interface)) {
                continue;
            }
            if (empty($bindDefinition->mockInteractor)) {
                continue;
            }

            $app->bind(
                abstract: $bindDefinition->interface,
                concrete: $bindDefinition->mockInteractor,
            );
        }
    }
}
