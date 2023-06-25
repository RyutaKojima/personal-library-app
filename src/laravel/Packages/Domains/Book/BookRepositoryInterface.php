<?php

declare(strict_types=1);


namespace Packages\Domains\Book;

interface BookRepositoryInterface
{
    public function exists(Book $book): bool;

    public function fetchFromIsbn(Isbn $isbn): Book;

    public function register(Book $book): Book;
}
