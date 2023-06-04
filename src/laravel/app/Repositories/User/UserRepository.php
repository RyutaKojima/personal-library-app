<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User as UserEloquent;
use Packages\Domains\User\User;
use Packages\Domains\User\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): int
    {
        $userEloquent = new UserEloquent();

        $userEloquent->fill([
            'name' => $user->name,
        ]);

        $userEloquent->save();

        return $userEloquent->id;
    }
}
