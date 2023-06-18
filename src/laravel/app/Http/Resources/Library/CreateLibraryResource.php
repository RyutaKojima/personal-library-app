<?php

declare(strict_types=1);

namespace App\Http\Resources\Library;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Packages\UseCases\Library\Create\CreateLibraryOutput;

/**
 * @mixin CreateLibraryOutput
 */
final class CreateLibraryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClass
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->createdLibrary->name,
            'identificationCode' => $this->createdLibrary->identificationCode,
        ];
    }
}
