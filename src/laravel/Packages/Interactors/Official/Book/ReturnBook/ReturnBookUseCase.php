<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Book\ReturnBook;

use Packages\Domains\Book\BookRepositoryInterface;
use Packages\Domains\Book\Isbn;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\Exceptions\InvalidArgumentException;
use Packages\Exceptions\StockShortageException;
use Packages\UseCases\Book\Return\ReturnBookInput;
use Packages\UseCases\Book\Return\ReturnBookOutput;
use Packages\UseCases\Book\Return\ReturnBookUseCaseInterface;

final class ReturnBookUseCase implements ReturnBookUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
        private readonly BookRepositoryInterface $bookRepository,
    ) {
    }

    /**
     * @param ReturnBookInput $input
     * @return ReturnBookOutput
     * @throws DataNotFoundException
     * @throws InvalidArgumentException
     * @throws StockShortageException
     */
    public function handle(ReturnBookInput $input): ReturnBookOutput
    {
        $library = $this->libraryRepository->fetchFromIdentificationCode($input->libraryCode);

        $isbn = new Isbn($input->isbn);
        $book = $this->bookRepository->fetchFromIsbn($library, $isbn);

        if ($book->getCurrentStocks() >= $book->getMaxStocks()) {
            throw new StockShortageException();
        }

//        $this->bookRepository->return($book);
//        $this->borrowedHistoryRepository->recordReturn($input->user, $book);

        return new ReturnBookOutput(
            book: $book,
        );
    }
}
