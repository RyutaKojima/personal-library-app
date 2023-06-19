<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Join;

use Packages\Domains\User\User;

final class JoinLibraryInput
{
    public function __construct(
        public readonly User $user,
        public readonly string $identificationCode,
    ) {
    }
}
