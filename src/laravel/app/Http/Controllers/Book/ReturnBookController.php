<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\ReturnBookRequest;
use App\Http\Resources\Book\ReturnBookResource;

final class ReturnBookController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(ReturnBookRequest $request): ReturnBookResource
    {
        return ReturnBookResource::make([]);
    }
}
