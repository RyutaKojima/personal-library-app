<?php

declare(strict_types=1);

namespace Packages\UseCases\User\Create;

final class CreateUserInput
{
    public function __construct(
        public readonly string $accountId,
        public readonly string $password,
        public readonly string $name,
    ) {
    }
}
