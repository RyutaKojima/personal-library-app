<?php

declare(strict_types=1);

namespace Packages\UseCases\Library\Join;

use Packages\Domains\Library\Library;

final class JoinLibraryOutput
{
    public function __construct(
        public readonly Library $library,
    ) {
    }
}
