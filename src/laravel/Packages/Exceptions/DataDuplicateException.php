<?php

declare(strict_types=1);

namespace Packages\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

final class DataDuplicateException extends Exception
{
    #[Pure]
    // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
    public function __construct(
        string $message = 'すでに登録されています',
        int $code = 0,
        Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
