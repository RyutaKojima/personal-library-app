<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Missing;

interface MissingBookUseCaseInterface
{
    public function handle(MissingBookInput $input): MissingBookOutput;
}
