<?php

declare(strict_types=1);

namespace Packages\UseCases\User\Create;

final class CreateUserOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $accountId,
        public readonly string $name,
    ) {
    }
}
