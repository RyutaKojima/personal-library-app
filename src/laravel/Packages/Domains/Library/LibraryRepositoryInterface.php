<?php

declare(strict_types=1);

namespace Packages\Domains\Library;

use Packages\Domains\User\User;

interface LibraryRepositoryInterface
{
    public function exists(Library $library): bool;

    public function establish(User $user, Library $library): Library;
}
