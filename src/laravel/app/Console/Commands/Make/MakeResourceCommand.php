<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Foundation\Console\ResourceMakeCommand;

class MakeResourceCommand extends ResourceMakeCommand
{
    protected $name = 'app:make-resource';

    protected $description = 'RestApi用の Resource クラスを生成します';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/resource.stub';
    }
}
