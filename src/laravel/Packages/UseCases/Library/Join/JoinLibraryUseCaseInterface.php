<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Join;

interface JoinLibraryUseCaseInterface
{
    public function handle(JoinLibraryInput $input): JoinLibraryOutput;
}
