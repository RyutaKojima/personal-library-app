<?php

declare(strict_types=1);

namespace Packages\Exceptions;

use Exception;

/**
 * 本の在庫数が足りない
 */
final class StockShortageException extends Exception
{
}
