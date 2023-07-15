<?php

declare(strict_types=1);

namespace Packages\Domains\Book;

use Packages\Domains\User\User;

interface BorrowedHistoryRepositoryInterface
{
    public function recordBorrow(User $user, Book $book): void;
}
