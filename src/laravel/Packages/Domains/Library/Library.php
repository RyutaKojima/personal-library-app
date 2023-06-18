<?php

declare(strict_types=1);

namespace Packages\Domains\Library;

final class Library
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $name,
        public readonly string $identificationCode,
    ) {
    }
}
