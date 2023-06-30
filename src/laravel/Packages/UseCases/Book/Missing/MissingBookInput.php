<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Missing;

use Packages\Domains\User\User;

final class MissingBookInput
{
    public function __construct(
        public readonly User $user,
        public readonly string $libraryCode,
        public readonly string $isbn,
    ) {
    }
}
