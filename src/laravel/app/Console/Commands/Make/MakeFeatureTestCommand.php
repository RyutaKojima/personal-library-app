<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Foundation\Console\TestMakeCommand;

class MakeFeatureTestCommand extends TestMakeCommand
{
    protected $name = 'app:make-test';

    protected $description = 'RestApi用の Test クラスを生成します';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/test-controller.stub';
    }
}
