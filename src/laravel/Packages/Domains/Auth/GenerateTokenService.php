<?php

declare(strict_types=1);


namespace Packages\Domains\Auth;

use Packages\Domains\User\User;
use Ramsey\Uuid\Uuid;

final class GenerateTokenService
{
    public function newToken(User $user): string
    {
        return hash(
            'sha3-512',
            $user->accountId . '-' . Uuid::uuid4()->toString(),
        );
    }
}
