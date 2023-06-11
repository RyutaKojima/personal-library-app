<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Resources\Auth\AuthLoginResource;
use Packages\Domains\User\Password;
use Packages\UseCases\Auth\Login\LoginInput;
use Packages\UseCases\Auth\Login\LoginUseCaseInterface;

final class AuthLoginController extends Controller
{
    public function __construct(
        private readonly LoginUseCaseInterface $useCase,
    ) {
    }

    public function __invoke(AuthLoginRequest $request): AuthLoginResource
    {
        $accountId = $request->string('account_id');
        $password = $request->string('password');

        $input = new LoginInput(
            $accountId->toString(),
            Password::makeByPhrase($password->toString()),
        );

        $output = $this->useCase->handle($input);

        return AuthLoginResource::make($output);
    }
}
