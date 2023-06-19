<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Library\Join;

use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;
use Packages\UseCases\Library\Join\JoinLibraryInput;
use Packages\UseCases\Library\Join\JoinLibraryOutput;
use Packages\UseCases\Library\Join\JoinLibraryUseCaseInterface;

final class JoinLibraryUseCase implements JoinLibraryUseCaseInterface
{
    public function __construct(
        private readonly LibraryRepositoryInterface $libraryRepository,
    ) {
    }

    /**
     * @throws DataNotFoundException
     */
    public function handle(JoinLibraryInput $input): JoinLibraryOutput
    {
        $library = $this->libraryRepository->fetchFromIdentificationCode($input->identificationCode);

        $this->libraryRepository->joinUser(
            user: $input->user,
            library: $library,
        );

        return new JoinLibraryOutput(
            library: $library,
        );
    }
}
