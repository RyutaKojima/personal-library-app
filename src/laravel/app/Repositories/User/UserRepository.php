<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User as UserEloquent;
use Packages\Domains\User\Password;
use Packages\Domains\User\User;
use Packages\Domains\User\UserRepositoryInterface;
use Packages\Exceptions\DataNotFoundException;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * @throws DataNotFoundException
     */
    public function findByAccountId(string $accountId): User
    {
        $userEloquent = UserEloquent::where('email', $accountId)->first();
        if ($userEloquent === null) {
            throw new DataNotFoundException();
        }

        return new User(
            accountId: $userEloquent->email,
            password: Password::makeByHash($userEloquent->password),
            name: $userEloquent->name,
            id: $userEloquent->id,
        );
    }

    public function save(User $user): User
    {
        $userEloquent = new UserEloquent();

        $userEloquent->fill([
            'email' => $user->accountId,
            'password' => $user->password->passwordHash,
            'name' => $user->name,
        ]);

        $userEloquent->save();

        return $user->setId($userEloquent->id);
    }
}
