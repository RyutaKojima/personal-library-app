<?php

declare(strict_types=1);

namespace Packages\Domains\Book;

use Packages\Exceptions\InvalidArgumentException;
use Packages\Exceptions\StockShortageException;

final class Book
{
    private int $currentStocks;
    private int $maxStocks;

    public function __construct(
        public readonly int|null $id,
        public readonly int $libraryId,
        public readonly string $title,
        public readonly Isbn $isbn,
        public readonly string $author,
        public readonly string $publisher,
        int $currentStocks = 0,
        int $maxStocks = 0,
    ) {
        $this->currentStocks = $currentStocks;
        $this->maxStocks = $maxStocks;
    }

    public function getCurrentStocks(): int
    {
        return $this->currentStocks;
    }

    public function getMaxStocks(): int
    {
        return $this->maxStocks;
    }

    public function newStocking(): self
    {
        $this->maxStocks++;
        $this->currentStocks++;

        return $this;
    }

    /**
     * @throws StockShortageException
     */
    public function borrow(): self
    {
        if ($this->currentStocks <= 0) {
            throw new StockShortageException();
        }

        $this->currentStocks--;

        return $this;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function return(): self
    {
        if ($this->currentStocks >= $this->maxStocks) {
            throw new InvalidArgumentException();
        }

        $this->currentStocks++;

        return $this;
    }

    public function missing(): self
    {
        return $this;
    }
}
