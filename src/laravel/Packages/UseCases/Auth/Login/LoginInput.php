<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Login;

use Packages\Domains\User\Password;

final class LoginInput
{
    public function __construct(
        public readonly string $accountId,
        public readonly Password $password,
    ) {
    }
}
