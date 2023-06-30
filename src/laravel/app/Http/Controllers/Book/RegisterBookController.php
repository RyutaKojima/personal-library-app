<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\RegisterBookRequest;
use App\Http\Resources\Book\RegisterBookResource;
use Illuminate\Support\Facades\DB;
use Packages\Domains\User\User;
use Packages\UseCases\Book\Register\RegisterBookInput;
use Packages\UseCases\Book\Register\RegisterBookUseCaseInterface;
use Throwable;

final class RegisterBookController extends Controller
{
    public function __construct(
        private readonly RegisterBookUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(RegisterBookRequest $request): RegisterBookResource
    {
        /** @var User $user */
        $user = $request->user();

        /** @var string $author */
        $author = $request->validated('author') ?? '';

        /** @var string $publisher */
        $publisher = $request->validated('publisher') ?? '';

        $input = new RegisterBookInput(
            user: $user,
            libraryCode: $request->string('libraryCode')->toString(),
            title: $request->string('title')->toString(),
            isbn: $request->string('isbn')->toString(),
            author: $author,
            publisher: $publisher,
        );

        $output = DB::transaction(function () use ($input) {
            return $this->useCase->handle($input);
        });

        return RegisterBookResource::make($output);
    }
}
