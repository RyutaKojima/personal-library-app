<?php

declare(strict_types=1);

namespace Packages\Domains\User;

final class User
{
    public function __construct(
        public readonly string $accountId,
        public readonly string $password,
        public readonly string $name,
    ) {
    }
}
