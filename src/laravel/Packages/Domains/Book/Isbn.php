<?php

declare(strict_types=1);

namespace Packages\Domains\Book;

use Packages\Exceptions\InvalidArgumentException;

/**
 * 国際標準図書番号：International Standard Book Number
 * ISBN 978-3-16-148410-0
 * ISBN 978-4033280103
 */
final class Isbn
{
    /**
     * 接頭記号
     * @var string
     */
    public readonly string $prefixSymbol;

    /**
     * グループ記号
     *
     * @return string
     */
    public readonly string $groupSymbol;


    /**
     * 出版者記号
     *
     * @return string
     */
    public readonly string $publisherSymbol;


    /**
     * 書名記号
     *
     * @return string
     */
    public readonly string $titleSymbol;

    /**
     * チェックディジット
     * @return string
     */
    public readonly string $checkDigit;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        public readonly string $isbn,
    ) {
        // 978-3-16-148410-0
        // 978-4033280103
        if (
            preg_match(
                pattern: '/(\d{3})-?(\d)-?(\d{2})-?(\d{6})-?(\d)/',
                subject: $isbn,
                matches: $matches,
            )
        ) {
            \Log::debug('match', $matches);

            $this->prefixSymbol = $matches[1];
            $this->groupSymbol = $matches[2];
            $this->publisherSymbol = $matches[3];
            $this->titleSymbol = $matches[4];
            $this->checkDigit = $matches[5];
            return;
        }

        throw new InvalidArgumentException();
    }

    public function getNoHyphen(): string
    {
        return sprintf(
            '%s-%s%s%s%s',
            $this->prefixSymbol,
            $this->groupSymbol,
            $this->publisherSymbol,
            $this->titleSymbol,
            $this->checkDigit,
        );
    }

    public function getWithHyphen(): string
    {
        return sprintf(
            '%s-%s-%s-%s-%s',
            $this->prefixSymbol,
            $this->groupSymbol,
            $this->publisherSymbol,
            $this->titleSymbol,
            $this->checkDigit,
        );
    }
}
