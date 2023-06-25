<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\MissingBookRequest;
use App\Http\Resources\Book\MissingBookResource;

final class MissingBookController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(MissingBookRequest $request): MissingBookResource
    {
        return MissingBookResource::make([]);
    }
}
