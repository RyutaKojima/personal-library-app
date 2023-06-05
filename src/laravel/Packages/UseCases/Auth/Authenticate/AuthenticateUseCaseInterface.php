<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Authenticate;

use Packages\Domains\Auth\UnAuthenticateException;

interface AuthenticateUseCaseInterface
{
    /**
     * @param AuthenticateInput $input
     * @return AuthenticateOutput
     * @throws UnAuthenticateException
     */
    public function handle(AuthenticateInput $input): AuthenticateOutput;
}
