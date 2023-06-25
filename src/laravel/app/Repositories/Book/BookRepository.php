<?php

declare(strict_types=1);

namespace App\Repositories\Book;

use App\Models\Book as BookEloquent;
use Packages\Domains\Book\Book;
use Packages\Domains\Book\BookRepositoryInterface;
use Packages\Domains\Book\Isbn;
use Packages\Exceptions\DataNotFoundException;
use Packages\Exceptions\InvalidArgumentException;

final class BookRepository implements BookRepositoryInterface
{
    /**
     * リポジトリ内に限定した共通処理
     *
     * @param Isbn $isbn
     * @return BookEloquent
     * @throws DataNotFoundException
     */
    private function find(Isbn $isbn): BookEloquent
    {
        $bookEloquent = BookEloquent::where(
            column: 'isbn',
            operator: '=',
            value: $isbn->getNoHyphen(),
        )->first();

        if ($bookEloquent === null) {
            throw new DataNotFoundException();
        }

        return $bookEloquent;
    }

    /**
     * @param Book $book
     * @return bool
     */
    public function exists(Book $book): bool
    {
        try {
            $this->find($book->isbn);

            return true;
        } catch (DataNotFoundException) {
            return false;
        }
    }

    /**
     * @param Isbn $isbn
     * @return Book
     * @throws DataNotFoundException
     */
    public function fetchFromIsbn(Isbn $isbn): Book
    {
        $bookEloquent = $this->find($isbn);

        return new Book(
            id: $bookEloquent->id,
            libraryId: $bookEloquent->library_id,
            title: $bookEloquent->title,
            isbn: $isbn,
            author: $bookEloquent->author,
            publisher: $bookEloquent->publisher,
            currentStocks: $bookEloquent->bookStock?->current_stocks ?? 0,
            maxStocks: $bookEloquent->bookStock?->max_stocks ?? 0,
        );
    }

    /**
     * @param Book $book
     * @return Book
     * @throws InvalidArgumentException
     */
    public function register(Book $book): Book
    {
        try {
            $bookEloquent = $this->find($book->isbn);

            $bookEloquent
                ->bookStock
                ->fill([
                    'max_stocks' => $bookEloquent->bookStock->max_stocks + 1,
                    'current_stocks' => $bookEloquent->bookStock->current_stocks + 1,
                ])
                ->save();

            $bookEloquent->refresh();
        } catch (DataNotFoundException) {
            /** @var BookEloquent $bookEloquent */
            $bookEloquent = BookEloquent::make([
                'title' => $book->title,
                'isbn' => $book->isbn->getNoHyphen(),
                'author' => $book->author,
                'publisher' => $book->publisher,
            ])
                ->forceFill([
                    'library_id' => $book->libraryId,
                ]);
            $bookEloquent->save();

            $bookEloquent = $bookEloquent->fresh();

            $bookEloquent->bookStock()->create([
                'max_stocks' => 1,
                'current_stocks' => 1,
            ]);
        }

        return new Book(
            id: $bookEloquent->id,
            libraryId: $bookEloquent->library_id,
            title: $bookEloquent->title,
            isbn: new Isbn($bookEloquent->isbn),
            author: $bookEloquent->author,
            publisher: $bookEloquent->publisher,
            currentStocks: $bookEloquent->bookStock?->current_stocks ?? 0,
            maxStocks: $bookEloquent->bookStock?->max_stocks ?? 0,
        );
    }
}
