<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Register;

interface RegisterBookUseCaseInterface
{
    public function handle(RegisterBookInput $input): RegisterBookOutput;
}
