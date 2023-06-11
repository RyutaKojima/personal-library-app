<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserMeRequest;
use App\Http\Resources\User\GetUserMeResource;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;

final class GetUserMeController extends Controller
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
    ) {
    }

    /**
     * @throws UnAuthenticateException
     */
    public function __invoke(GetUserMeRequest $request): GetUserMeResource
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        return new GetUserMeResource(
            $authOutput->user,
        );
    }
}
