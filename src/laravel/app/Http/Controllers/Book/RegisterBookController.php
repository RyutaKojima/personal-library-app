<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\RegisterBookRequest;
use App\Http\Resources\Book\RegisterBookResource;
use Illuminate\Support\Facades\DB;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\UseCases\Auth\Authenticate\AuthenticateInput;
use Packages\UseCases\Auth\Authenticate\AuthenticateUseCaseInterface;
use Packages\UseCases\Book\Register\RegisterBookInput;
use Packages\UseCases\Book\Register\RegisterBookUseCaseInterface;
use Throwable;

final class RegisterBookController extends Controller
{
    public function __construct(
        private readonly AuthenticateUseCaseInterface $authenticateUseCase,
        private readonly RegisterBookUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws Throwable
     * @throws UnAuthenticateException
     */
    public function __invoke(RegisterBookRequest $request): RegisterBookResource
    {
        $token = (string)$request->bearerToken();
        $authOutput = $this->authenticateUseCase->handle(
            new AuthenticateInput($token),
        );

        $input = new RegisterBookInput(
            user: $authOutput->user,
            libraryCode: $request->validated('libraryCode'),
            title: $request->validated('title'),
            isbn: $request->validated('isbn'),
            author: $request->validated('author') ?? '',
            publisher: $request->validated('publisher') ?? '',
        );

        $output = DB::transaction(function () use ($input) {
            return $this->useCase->handle($input);
        });

        return RegisterBookResource::make($output);
    }
}
