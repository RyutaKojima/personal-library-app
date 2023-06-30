<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\MissingBookRequest;
use App\Http\Resources\Book\MissingBookResource;
use DB;
use Packages\Domains\User\User;
use Packages\UseCases\Book\Missing\MissingBookInput;
use Packages\UseCases\Book\Missing\MissingBookUseCaseInterface;
use Throwable;

final class MissingBookController extends Controller
{
    public function __construct(
        private readonly MissingBookUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(MissingBookRequest $request): MissingBookResource
    {
        /** @var User $user */
        $user = $request->user();

        $input = new MissingBookInput(
            user: $user,
            libraryCode: $request->string('libraryCode')->toString(),
            isbn: $request->string('isbn')->toString(),
        );

        $output = DB::transaction(function () use ($input) {
            return $this->useCase->handle($input);
        });

        return MissingBookResource::make($output);
    }
}
