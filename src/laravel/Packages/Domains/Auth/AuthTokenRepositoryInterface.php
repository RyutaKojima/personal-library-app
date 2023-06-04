<?php

declare(strict_types=1);


namespace Packages\Domains\Auth;

use Packages\Domains\User\User;

interface AuthTokenRepositoryInterface
{
    public const MINUTES_UNTIL_EXPIRATION = 60 * 6;

    public function get(User $user): string;

    public function set(
        User $user,
        string $token,
        int $minutesUntilExpiration = self::MINUTES_UNTIL_EXPIRATION,
    ): void;

    public function clear(User $user): void;
}
