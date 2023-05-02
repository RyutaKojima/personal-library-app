<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeControllerCommand extends ControllerMakeCommand
{
    protected $name = 'app:make-controller';

    protected $description = 'RestApi用の Controller クラスを生成します';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/controller.stub';
    }
}
