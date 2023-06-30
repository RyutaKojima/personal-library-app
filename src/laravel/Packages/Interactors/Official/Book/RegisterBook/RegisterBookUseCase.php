<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Book\RegisterBook;

use Packages\Domains\Book\Book;
use Packages\Domains\Book\BookRepositoryInterface;
use Packages\Domains\Book\Isbn;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\Exceptions\InvalidArgumentException;
use Packages\UseCases\Book\Register\RegisterBookInput;
use Packages\UseCases\Book\Register\RegisterBookOutput;
use Packages\UseCases\Book\Register\RegisterBookUseCaseInterface;

final class RegisterBookUseCase implements RegisterBookUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
        private readonly BookRepositoryInterface $bookRepository,
    ) {
    }

    /**
     * @throws DataNotFoundException
     * @throws InvalidArgumentException
     */
    public function handle(RegisterBookInput $input): RegisterBookOutput
    {
        $library = $this->libraryRepository->fetchFromIdentificationCode($input->libraryCode);

        if ($library->id === null) {
            throw new DataNotFoundException();
        }

        $book = $this->bookRepository->register(
            new Book(
                id: null,
                libraryId: $library->id,
                title: $input->title,
                isbn: new Isbn($input->isbn),
                author: $input->author,
                publisher: $input->publisher,
            )
        );

        return new RegisterBookOutput(
            registeredBook: $book,
        );
    }
}
