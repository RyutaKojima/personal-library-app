<?php

declare(strict_types=1);

namespace Packages\UseCases\User\Create;

interface CreateUserUseCaseInterface
{
    public function handle(CreateUserInput $input): CreateUserOutput;
}
