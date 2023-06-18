<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Create;

use Packages\Domains\User\User;

final class CreateLibraryInput
{
    public function __construct(
        public readonly User $user,
        public readonly string $name,
        public readonly string $identificationCode,
    ) {
    }
}
