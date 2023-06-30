<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Return;

interface ReturnBookUseCaseInterface
{
    public function handle(ReturnBookInput $input): ReturnBookOutput;
}
