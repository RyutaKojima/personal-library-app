<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Register;

use Packages\Domains\User\User;

final class RegisterBookInput
{
    public function __construct(
        public readonly User $user,
        public readonly string $libraryCode,
        public readonly string $title,
        public readonly string $isbn,
        public readonly string $author,
        public readonly string $publisher,
    ) {
    }
}
