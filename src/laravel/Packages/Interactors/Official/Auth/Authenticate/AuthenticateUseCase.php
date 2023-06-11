<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Auth\Authenticate;

use Packages\Domains\Auth\AuthTokenRepositoryInterface;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\Domains\User\UserRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateOutput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;

final class AuthenticateUseCase implements AuthenticateUseCaseInterface
{
    public function __construct(
        private readonly AuthTokenRepositoryInterface $authTokenRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    /**
     * @param AuthenticateInput $input
     * @return AuthenticateOutput
     * @throws UnAuthenticateException
     */
    public function handle(AuthenticateInput $input): AuthenticateOutput
    {
        $accountId = $this->authTokenRepository->getAccountIdByToken($input->token);

        try {
            if (!$accountId) {
                throw new DataNotFoundException();
            }

            $user = $this->userRepository->findByAccountId($accountId);

            return new AuthenticateOutput(
                $user,
            );
        } catch (DataNotFoundException $e) {
            throw new UnAuthenticateException('Not authenticated', 0, $e);
        }
    }
}
