<?php

declare(strict_types=1);

namespace Packages\UseCases\User\Create;

use Packages\Domains\User\Password;

final class CreateUserInput
{
    public function __construct(
        public readonly string $accountId,
        public readonly Password $password,
        public readonly string $name,
    ) {
    }
}
