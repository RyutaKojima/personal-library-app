<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\RegisterBookRequest;
use App\Http\Resources\Book\RegisterBookResource;

final class RegisterBookController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(RegisterBookRequest $request): RegisterBookResource
    {
        return RegisterBookResource::make([]);
    }
}
