<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Authenticate;

use Packages\Domains\User\User;

final class AuthenticateOutput
{
    public function __construct(
        public readonly User $user,
    ) {
    }
}
