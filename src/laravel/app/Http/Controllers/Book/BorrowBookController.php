<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BorrowBookRequest;
use App\Http\Resources\Book\BorrowBookResource;

final class BorrowBookController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(BorrowBookRequest $request): BorrowBookResource
    {
        return BorrowBookResource::make([]);
    }
}
