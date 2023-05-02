<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class MakeRestApiCommand extends Command
{
    protected $signature = 'app:make-rest-api {name}';

    protected $description = 'RestAPIを実装するためのファイルセットを作成します';

    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));

        $controllerName = "{$name}Controller";
        $requestName = "{$name}Request";
        $resourceName = "{$name}Resource";

        $this->call('app:make-controller', [
            'name' => $controllerName,
        ]);

        $this->call('app:make-request', [
            'name' => $requestName,
        ]);

        $this->call('app:make-resource', [
            'name' => $resourceName,
        ]);

        $this->call('make:test', [
            'name' => "Controller/{$controllerName}Test",
        ]);

        return self::SUCCESS;
    }
}
