<?php

declare(strict_types=1);

namespace Packages\Domains\User;

interface UserRepositoryInterface
{
    public function save(User $user): int;
}
