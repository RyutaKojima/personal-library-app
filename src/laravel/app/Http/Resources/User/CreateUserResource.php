<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Packages\UseCases\User\Create\CreateUserOutput;

/**
 * @mixin CreateUserOutput
 */
final class CreateUserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClass
    public function toArray(Request $request): array
    {
        return [
            'accountId' => $this->accountId,
            'name' => $this->name,
        ];
    }
}
