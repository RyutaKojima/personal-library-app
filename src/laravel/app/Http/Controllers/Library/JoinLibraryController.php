<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\JoinLibraryRequest;
use App\Http\Resources\Library\JoinLibraryResource;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;
use Packages\UseCases\Library\Join\JoinLibraryInput;
use Packages\UseCases\Library\Join\JoinLibraryUseCaseInterface;

final class JoinLibraryController extends Controller
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
        private readonly JoinLibraryUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws UnAuthenticateException
     */
    public function __invoke(JoinLibraryRequest $request): JoinLibraryResource
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        $input = new JoinLibraryInput(
            $authOutput->user,
            $request->string('identification_code')->toString(),
        );

        $output = $this->useCase->handle($input);

        return new JoinLibraryResource($output);
    }
}
