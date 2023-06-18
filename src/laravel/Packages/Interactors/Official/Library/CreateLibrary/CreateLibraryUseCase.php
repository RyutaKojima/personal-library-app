<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Library\CreateLibrary;

use Packages\Domains\Library\Library;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataDuplicateException;
use Packages\UseCases\Library\Create\CreateLibraryInput;
use Packages\UseCases\Library\Create\CreateLibraryOutput;
use Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface;

final class CreateLibraryUseCase implements CreateLibraryUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
    ) {
    }

    /**
     * @throws DataDuplicateException
     */
    public function handle(CreateLibraryInput $input): CreateLibraryOutput
    {
        $library = new Library(
            null,
            $input->name,
            $input->identificationCode,
        );

        $exists = $this->libraryRepository->exists($library);
        if ($exists) {
            throw new DataDuplicateException();
        }

        $newLibrary = $this->libraryRepository->establish($input->user, $library);

        return new CreateLibraryOutput(
            createdLibrary: $newLibrary,
        );
    }
}
