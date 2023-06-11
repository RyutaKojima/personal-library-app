<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Auth\Login;

use Packages\Domains\Auth\AuthTokenRepositoryInterface;
use Packages\Domains\Auth\GenerateTokenService;
use Packages\Domains\User\UserRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\UseCases\Auth\Login\LoginInput;
use Packages\UseCases\Auth\Login\LoginOutput;
use Packages\UseCases\Auth\Login\LoginUseCaseInterface;

final class LoginUseCase implements LoginUseCaseInterface
{
    public function __construct(
        private readonly GenerateTokenService $generateTokenService,
        private readonly UserRepositoryInterface $userRepository,
        private readonly AuthTokenRepositoryInterface $authTokenRepository,
    ) {
    }

    /**
     * @throws DataNotFoundException
     */
    public function handle(LoginInput $input): LoginOutput
    {
        $user = $this->userRepository->findByAccountId($input->accountId);

        $isVerified = $user->password->verify($input->password);

        $token = $isVerified
            ? $this->generateTokenService->newToken($user)
            : null;

        if ($token) {
            $this->authTokenRepository->set($user, $token);
        }

        return new LoginOutput(
            isVerified: $isVerified,
            token: $token,
        );
    }
}
