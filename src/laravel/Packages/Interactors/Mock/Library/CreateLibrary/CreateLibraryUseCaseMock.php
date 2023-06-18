<?php

declare(strict_types=1);

namespace Packages\Interactors\Mock\Library\CreateLibrary;

use Packages\Domains\Library\Library;
use Packages\UseCases\Library\Create\CreateLibraryInput;
use Packages\UseCases\Library\Create\CreateLibraryOutput;

final class CreateLibraryUseCaseMock implements \Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface
{
    public function handle(CreateLibraryInput $input): CreateLibraryOutput
    {
        return new CreateLibraryOutput(
            createdLibrary: new Library(
                id: 1,
                name: $input->name,
                identificationCode: $input->identificationCode,
            ),
        );
    }
}
