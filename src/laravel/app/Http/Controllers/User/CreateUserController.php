<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\CreateUserResource;
use Packages\Domains\User\Password;
use Packages\UseCases\User\Create\CreateUserInput;
use Packages\UseCases\User\Create\CreateUserUseCaseInterface;

final class CreateUserController extends Controller
{
    public function __construct(
        private readonly CreateUserUseCaseInterface $useCase,
    ) {
    }

    public function __invoke(CreateUserRequest $request): CreateUserResource
    {
        $accountId = $request->string('account_id');
        $password = $request->string('password');
        $name = $request->string('name');

        $createUserInput = new CreateUserInput(
            $accountId->toString(),
            Password::makeByPhrase($password->toString()),
            $name->toString(),
        );

        $output = $this->useCase->handle($createUserInput);

        return CreateUserResource::make($output);
    }
}
