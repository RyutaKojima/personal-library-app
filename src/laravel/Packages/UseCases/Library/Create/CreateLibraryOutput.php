<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Create;

use Packages\Domains\Library\Library;

final class CreateLibraryOutput
{
    public function __construct(
        public readonly Library $createdLibrary,
    ) {
    }
}
