<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Auth\Logout;

use Packages\Domains\Auth\AuthTokenRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\UseCases\Auth\Logout\LogoutInput;
use Packages\UseCases\Auth\Logout\LogoutUseCaseInterface;

final class LogoutUseCase implements LogoutUseCaseInterface
{
    public function __construct(
        private readonly AuthTokenRepositoryInterface $authTokenRepository,
    ) {
    }

    public function handle(LogoutInput $input): void
    {
        $this->authTokenRepository->clear($input->user);
    }
}
