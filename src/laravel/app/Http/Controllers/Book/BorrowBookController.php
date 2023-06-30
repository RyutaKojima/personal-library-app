<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BorrowBookRequest;
use App\Http\Resources\Book\BorrowBookResource;
use Illuminate\Support\Facades\DB;
use Packages\Domains\Auth\UnAuthenticateException;
use Packages\Domains\User\User;
use Packages\UseCases\Book\Borrow\BorrowBookInput;
use Packages\UseCases\Book\Borrow\BorrowBookUseCaseInterface;
use Throwable;

final class BorrowBookController extends Controller
{
    public function __construct(
        private readonly BorrowBookUseCaseInterface $useCase,
    ) {
    }

    /**
     * @throws Throwable
     * @throws UnAuthenticateException
     */
    public function __invoke(BorrowBookRequest $request): BorrowBookResource
    {
        /** @var User $user */
        $user = $request->user();

        $input = new BorrowBookInput(
            user: $user,
            libraryCode: $request->string('libraryCode')->toString(),
            isbn: $request->string('isbn')->toString(),
        );

        $output = DB::transaction(function () use ($input) {
            return $this->useCase->handle($input);
        });

        return BorrowBookResource::make($output);
    }
}
