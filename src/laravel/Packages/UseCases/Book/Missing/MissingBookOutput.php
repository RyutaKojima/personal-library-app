<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Missing;

use Packages\Domains\Book\Book;

final class MissingBookOutput
{
    public function __construct(
        public readonly Book $book,
    ) {
    }
}
