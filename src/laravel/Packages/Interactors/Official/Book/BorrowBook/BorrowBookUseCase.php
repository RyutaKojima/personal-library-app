<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Book\BorrowBook;

use Packages\Domains\Book\BookRepositoryInterface;
use Packages\Domains\Book\BorrowedHistoryRepositoryInterface;
use Packages\Domains\Book\Isbn;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\Exceptions\InvalidArgumentException;
use Packages\Exceptions\StockShortageException;
use Packages\UseCases\Book\Borrow\BorrowBookInput;
use Packages\UseCases\Book\Borrow\BorrowBookOutput;
use Packages\UseCases\Book\Borrow\BorrowBookUseCaseInterface;

final class BorrowBookUseCase implements BorrowBookUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
        private readonly BookRepositoryInterface $bookRepository,
        private readonly BorrowedHistoryRepositoryInterface $borrowedHistoryRepository,
    ) {
    }

    /**
     * @param BorrowBookInput $input
     * @return BorrowBookOutput
     * @throws DataNotFoundException
     * @throws StockShortageException
     * @throws InvalidArgumentException
     */
    public function handle(BorrowBookInput $input): BorrowBookOutput
    {
        $library = $this->libraryRepository->fetchFromIdentificationCode($input->libraryCode);

        $book = $this->bookRepository->fetchFromIsbn($library, new Isbn($input->isbn));

        $book->borrow();

        $this->bookRepository->save($book);
        $this->borrowedHistoryRepository->recordBorrow($input->user, $book);

        return new BorrowBookOutput(
            book: $book,
        );
    }
}
