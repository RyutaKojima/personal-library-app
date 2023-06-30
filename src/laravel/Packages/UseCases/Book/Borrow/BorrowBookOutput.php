<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Borrow;

use Packages\Domains\Book\Book;

final class BorrowBookOutput
{
    public function __construct(
        public readonly Book $book,
    ) {
    }
}
