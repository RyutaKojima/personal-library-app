<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Login;

final class LoginOutput
{
    public function __construct(
        public readonly bool $isVerified,
        public readonly string|null $token,
    ) {
    }
}
