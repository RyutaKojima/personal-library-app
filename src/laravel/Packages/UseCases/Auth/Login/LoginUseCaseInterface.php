<?php

declare(strict_types=1);

namespace Packages\UseCases\Auth\Login;

interface LoginUseCaseInterface
{
    public function handle(LoginInput $input): LoginOutput;
}
