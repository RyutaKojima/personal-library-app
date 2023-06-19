<?php

declare(strict_types=1);

namespace App\Repositories\Library;

use App\Models\Library as LibraryEloquent;
use App\Models\Member;
use App\Models\User as UserEloquent;
use Packages\Domains\Library\Library;
use Packages\Domains\Library\LibraryRepositoryInterface;
use Packages\Domains\Library\MemberRoleEnum;
use Packages\Domains\User\User;
use Packages\Exceptions\DataNotFoundException;

final class LibraryRepository implements LibraryRepositoryInterface
{
    /**
     * @throws DataNotFoundException
     */
    public function fetchFromIdentificationCode(string $identificationCode): Library
    {
        $libraryEloquent = LibraryEloquent::where(
            column: 'identification_code',
            operator: '=',
            value: $identificationCode,
        )
            ->first();

        if ($libraryEloquent === null) {
            throw new DataNotFoundException();
        }

        return new Library(
            id: $libraryEloquent->id,
            name: $libraryEloquent->name,
            identificationCode: $identificationCode,
        );
    }

    public function exists(Library $library): bool
    {
        return LibraryEloquent::where(
            column: 'identification_code',
            operator: '=',
            value: $library->identificationCode,
        )->exists();
    }

    public function establish(User $user, Library $library): Library
    {
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
                'user_id' => $user->id,
            ])
            ->fill([
                'role' => MemberRoleEnum::Owner->value,
            ])
            ->save();

        return new Library(
            $libraryEloquent->id,
            $libraryEloquent->name,
            $libraryEloquent->identification_code,
        );
    }

    /**
     * @throws DataNotFoundException
     */
    public function joinUser(User $user, Library $library): Library
    {
        $libraryEloquent = LibraryEloquent::where(
            column: 'identification_code',
            operator: '=',
            value: $library->identificationCode,
        )
            ->first();

        if ($libraryEloquent === null) {
            throw new DataNotFoundException();
        }

        $libraryEloquent
            ->members()
            ->forceCreate([
                'user_id' => $user->id,
                'role' => MemberRoleEnum::Member->value,
            ]);

        return $library;
    }
}
