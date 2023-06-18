<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\CreateLibraryRequest;
use App\Http\Resources\Library\CreateLibraryResource;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;
use Packages\UseCases\Library\Create\CreateLibraryInput;
use Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface;

final class CreateLibraryController extends Controller
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
        private readonly CreateLibraryUseCaseInterface $createLibraryUseCase,
    ) {
    }

    public function __invoke(CreateLibraryRequest $request): CreateLibraryResource
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        $input = new CreateLibraryInput(
            $authOutput->user,
            $request->string('name')->toString(),
            $request->string('identification_code')->toString(),
        );

        $output = $this->createLibraryUseCase->handle($input);

        return CreateLibraryResource::make($output);
    }
}
