<?php

declare(strict_types=1);

namespace Packages\Domains\Library;

use Packages\Domains\User\User;
use Packages\Exceptions\DataNotFoundException;

interface LibraryRepositoryInterface
{
    /**
     * @throws DataNotFoundException
     */
    public function fetchFromIdentificationCode(string $identificationCode): Library;

    public function exists(Library $library): bool;

    public function establish(User $user, Library $library): Library;

    public function joinUser(User $user, Library $library): Library;
}
