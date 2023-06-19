<?php

declare(strict_types=1);

namespace Packages\Domains\Library;

use Packages\Domains\User\User;

final class LibraryRepositoryMock implements LibraryRepositoryInterface
{
    public function fetchFromIdentificationCode(string $identificationCode): Library
    {
        return new Library(
            id: 1,
            name: 'mock-library',
            identificationCode: $identificationCode,
        );
    }
    public function exists(Library $library): bool
    {
        return false;
    }

    // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInImplementedInterfaceBeforeLastUsed
    public function establish(User $user, Library $library): Library
    {
        return new Library(
            id: 1,
            name: $library->name,
            identificationCode: $library->identificationCode,
        );
    }

    public function joinUser(User $user, Library $library): Library
    {
        return $library;
    }
}
