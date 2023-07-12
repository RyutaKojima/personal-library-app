<?php

declare(strict_types=1);

namespace App\Repositories\Book;

use App\Models\BorrowedHistory;
use Carbon\CarbonImmutable;
use Packages\Domains\Book\Book;
use Packages\Domains\Book\BorrowedHistoryRepositoryInterface;
use Packages\Domains\User\User;

final class BorrowedHistoryRepository implements BorrowedHistoryRepositoryInterface
{
    public function recordBorrow(User $user, Book $book): void
    {
        $borrowedHistory = BorrowedHistory::make([
            'borrowed_at' => CarbonImmutable::now(),
            'returned_at' => null,
            'status' => 'borrowed',
        ])
            ->forceFill([
                'borrower_id' => $user->id,
                'book_id' => $book->id,
            ]);

        $borrowedHistory->save();
    }
}
