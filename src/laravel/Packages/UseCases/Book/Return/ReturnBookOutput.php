<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Return;

use Packages\Domains\Book\Book;

final class ReturnBookOutput
{
    public function __construct(
        public readonly Book $book,
    ) {
    }
}
