<?php

declare(strict_types=1);

namespace Tests\FeatureUtil;

use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Application;
use Packages\Domains\User\Password;
use Packages\Domains\User\User;
use Packages\Exceptions\DataNotFoundException;
use Packages\Interactors\Official\Auth\Login\LoginUseCase;
use Packages\UseCases\Auth\Login\LoginInput;

final class Authenticate
{
    public const TEST_ACCOUNT_ID = 'example@gmail.com';
    public const TEST_PASSWORD = 'password';
    public const TEST_NAME = '山田太郎';

    /**
     * @throws DataNotFoundException
     */
    public static function makeDummyUser(Application $app): User
    {
        $userRepository = $app->make(UserRepository::class);

        $userRepository->save(
            new User(
                self::TEST_ACCOUNT_ID,
                Password::makeByPhrase(self::TEST_PASSWORD),
                self::TEST_NAME,
            )
        );

        return $userRepository->findByAccountId(self::TEST_ACCOUNT_ID);
    }

    /**
     * @throws DataNotFoundException
     */
    public static function login(Application $app): string
    {
        $input = new LoginInput(
            self::TEST_ACCOUNT_ID,
            Password::makeByPhrase(self::TEST_PASSWORD),
        );

        $useCase = $app->make(LoginUseCase::class);
        return $useCase->handle($input)->token;
    }
}
