<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\ReturnBookRequest;
use App\Http\Resources\Book\ReturnBookResource;
use Illuminate\Support\Facades\DB;
use Packages\Domains\User\User;
use Packages\UseCases\Book\Return\ReturnBookInput;
use Packages\UseCases\Book\Return\ReturnBookUseCaseInterface;
use Throwable;

final class ReturnBookController extends Controller
{
    public function __construct(
        private readonly ReturnBookUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(ReturnBookRequest $request): ReturnBookResource
    {
        /** @var User $user */
        $user = $request->user();

        $input = new ReturnBookInput(
            user: $user,
            libraryCode: $request->string('libraryCode')->toString(),
            isbn: $request->string('isbn')->toString(),
        );

        $output = DB::transaction(function () use ($input) {
            return $this->useCase->handle($input);
        });

        return ReturnBookResource::make($output);
    }
}
