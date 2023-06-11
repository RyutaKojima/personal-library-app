<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLogoutRequest;
use App\Http\Resources\Auth\AuthLogoutResource;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;
use Packages\UseCases\Auth\Logout\LogoutInput;
use Packages\UseCases\Auth\Logout\LogoutUseCaseInterface;

final class AuthLogoutController extends Controller
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
        private readonly LogoutUseCaseInterface $logoutUseCase,
    ) {
    }

    /**
     * @throws UnAuthenticateException
     */
    public function __invoke(AuthLogoutRequest $request): AuthLogoutResource
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        $input = new LogoutInput($authOutput->user);

        $this->logoutUseCase->handle($input);

        return AuthLogoutResource::make([]);
    }
}
