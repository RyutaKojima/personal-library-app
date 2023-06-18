<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Create;

interface CreateLibraryUseCaseInterface
{
    public function handle(CreateLibraryInput $input): CreateLibraryOutput;
}
