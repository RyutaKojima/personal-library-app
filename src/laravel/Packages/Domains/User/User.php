<?php

declare(strict_types=1);

namespace Packages\Domains\User;

final class User
{
    public function __construct(
        public readonly string $accountId,
        public readonly Password $password,
        public readonly string $name,
        public readonly int|null $id = null,
    ) {
    }

    public function setId(int $id): User
    {
        return new User(
            accountId: $this->accountId,
            password: $this->password,
            name: $this->name,
            id: $id,
        );
    }
}
