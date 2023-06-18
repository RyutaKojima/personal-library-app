<?php

declare(strict_types=1);

namespace App\Repositories\Library;

use App\Models\Library as LibraryEloquent;
use App\Models\Member;
use App\Models\User as UserEloquent;
use Packages\Domains\Library\Library;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Domains\User\User;
use Packages\Exceptions\DataNotFoundException;

final class LibraryRepository implements LibraryRepositoryInterface
{
    public function exists(Library $library): bool
    {
        return LibraryEloquent::where(
            column: 'identification_code',
            operator: '=',
            value: $library->identificationCode,
        )->exists();
    }

    /**
     * @throws DataNotFoundException
     */
    public function establish(User $user, Library $library): Library
    {
        $userEloquent = UserEloquent::firstWhere('email', $user->accountId);
        if ($userEloquent === null) {
            throw new DataNotFoundException('ユーザーが存在しません');
        }

        // 1. 図書館データを作成する
        $libraryEloquent = new LibraryEloquent();

        $libraryEloquent
            ->fill([
                'name' => $library->name,
            ])
            ->forceFill([
                'identification_code' => $library->identificationCode,
            ]);

        $libraryEloquent->save();
        $libraryEloquent->refresh();

        // 2. 図書館に、作成者をオーナーとして所属させる
        /** @var Member $member */
        $member = $libraryEloquent->members()->make();
        $member
            ->forceFill([
                'user_id' => $userEloquent->id,
            ])
            ->fill([
                'role' => 'member',
            ])
            ->save();

        return new Library(
            $libraryEloquent->id,
            $libraryEloquent->name,
            $libraryEloquent->identification_code,
        );
    }
}
