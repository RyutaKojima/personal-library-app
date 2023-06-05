<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Logout;

use Packages\Domains\User\User;

interface LogoutUseCaseInterface
{
    public function handle(LogoutInput $input): void;
}
