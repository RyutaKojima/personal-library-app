<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Logout;

use Packages\Domains\User\User;

final class LogoutInput
{
    public function __construct(
        public readonly User $user,
    ) {
    }
}
