<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Foundation\Console\RequestMakeCommand;

final class MakeRequestCommand extends RequestMakeCommand
{
    protected $name = 'app:make-request';

    protected $description = 'RestApi用の Request クラスを生成します';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/request.stub';
    }
}
