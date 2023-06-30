<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticateSelfCustomize
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     * @throws UnAuthenticateException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        $request->setUserResolver(fn() => $authOutput->user);

        return $next($request);
    }
}
