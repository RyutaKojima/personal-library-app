<?php

declare(strict_types=1);

namespace Packages\Interactors\Mock\Auth\User;

use Packages\UseCases\User\Create\CreateUserInput;
use Packages\UseCases\User\Create\CreateUserOutput;
use Packages\UseCases\User\Create\CreateUserUseCaseInterface;

final class CreateUserUseCaseMock implements CreateUserUseCaseInterface
{
    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInImplementedInterface
    public function handle(CreateUserInput $input): CreateUserOutput
    {
        return new CreateUserOutput(
            1,
            '',
            '',
            '',
        );
    }
}
