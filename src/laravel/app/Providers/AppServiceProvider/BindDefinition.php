<?php

declare(strict_types=1);

namespace App\Providers\AppServiceProvider;

final class BindDefinition
{
    public function __construct(
        public readonly string $interface,
        public readonly string $officialInteractor,
        public readonly string $mockInteractor,
    ) {
    }
}
