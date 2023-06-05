<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Authenticate;

final class AuthenticateInput
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}
