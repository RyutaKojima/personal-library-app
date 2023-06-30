<?php

declare(strict_types=1);

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Packages\UseCases\Book\Missing\MissingBookOutput;

/**
 * @mixin MissingBookOutput
 */
final class MissingBookResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClass
    public function toArray(Request $request): array
    {
        return [
        ];
    }
}
