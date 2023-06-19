<?php

declare(strict_types=1);

namespace App\Http\Resources\Library;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Packages\UseCases\Library\Join\JoinLibraryOutput;

/**
 * @mixin JoinLibraryOutput
 */
final class JoinLibraryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClass
    public function toArray(Request $request): array
    {
        return [];
    }
}
