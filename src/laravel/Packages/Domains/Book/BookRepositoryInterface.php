<?php

declare(strict_types=1);

namespace Packages\Domains\Book;

use Packages\Domains\Library\Library;

interface BookRepositoryInterface
{
    public function exists(Book $book): bool;

    public function fetchFromIsbn(Library $library, Isbn $isbn): Book;

    public function register(Book $book): Book;
}
