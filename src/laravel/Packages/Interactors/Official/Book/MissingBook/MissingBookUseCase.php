<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Book\MissingBook;

use Packages\Domains\Book\BookRepositoryInterface;
use Packages\Domains\Book\Isbn;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\Exceptions\InvalidArgumentException;
use Packages\UseCases\Book\Missing\MissingBookInput;
use Packages\UseCases\Book\Missing\MissingBookOutput;
use Packages\UseCases\Book\Missing\MissingBookUseCaseInterface;

final class MissingBookUseCase implements MissingBookUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
        private readonly BookRepositoryInterface $bookRepository,
    ) {
    }

    /**
     * @param MissingBookInput $input
     * @return MissingBookOutput
     * @throws DataNotFoundException
     * @throws InvalidArgumentException
     */
    public function handle(MissingBookInput $input): MissingBookOutput
    {
        $library = $this->libraryRepository->fetchFromIdentificationCode($input->libraryCode);

        $isbn = new Isbn($input->isbn);
        $book = $this->bookRepository->fetchFromIsbn($library, $isbn);

//        $this->bookRepository->missing($book);
//        $this->borrowedHistoryRepository->recordMissing($input->user, $book);

        return new MissingBookOutput(
            book: $book,
        );
    }
}
