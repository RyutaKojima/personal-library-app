<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Register;

use Packages\Domains\Book\Book;

final class RegisterBookOutput
{
    public function __construct(
        public readonly Book $registeredBook,
    ) {
    }
}
