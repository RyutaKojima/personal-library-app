<?php

declare(strict_types=1);

namespace Packages\Interactors\Official\Auth\User;

use Packages\Domains\User\User;
use Packages\Domains\User\UserRepositoryInterface;
use Packages\UseCases\User\Create\CreateUserInput;
use Packages\UseCases\User\Create\CreateUserOutput;
use Packages\UseCases\User\Create\CreateUserUseCaseInterface;

final class CreateUserUseCase implements CreateUserUseCaseInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $createUserRepository,
    ) {
    }

    public function handle(CreateUserInput $input): CreateUserOutput
    {
        $user = new User(
            $input->accountId,
            $input->password,
            $input->name,
        );

        $id = $this->createUserRepository->save($user);

        return new CreateUserOutput(
            id: $id,
            accountId: $user->accountId,
            name: $user->name,
        );
    }
}
