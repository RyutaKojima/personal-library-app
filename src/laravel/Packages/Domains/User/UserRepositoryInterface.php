<?php

declare(strict_types=1);

namespace Packages\Domains\User;

use Packages\Exceptions\DataNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @throws DataNotFoundException
     */
    public function findByAccountId(string $accountId): User;

    public function save(User $user): int;
}
