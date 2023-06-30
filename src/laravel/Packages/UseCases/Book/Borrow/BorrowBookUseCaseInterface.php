<?php

declare(strict_types=1);

namespace Packages\UseCases\Book\Borrow;

interface BorrowBookUseCaseInterface
{
    public function handle(BorrowBookInput $input): BorrowBookOutput;
}
