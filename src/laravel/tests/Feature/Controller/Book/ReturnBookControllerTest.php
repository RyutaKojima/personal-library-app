<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Book;

use App\Models\BookStock;
use Packages\Exceptions\DataNotFoundException;
use Packages\UseCases\Book\Borrow\BorrowBookInput;
use Packages\UseCases\Book\Borrow\BorrowBookUseCaseInterface;
use Packages\UseCases\Book\Register\RegisterBookInput;
use Packages\UseCases\Book\Register\RegisterBookUseCaseInterface;
use Packages\UseCases\Library\Create\CreateLibraryInput;
use Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface;
use Tests\AuthorizedTestCase;

final class ReturnBookControllerTest extends AuthorizedTestCase
{
    /**
     * @throws DataNotFoundException
     */
    public function setUp(): void
    {
        parent::setUp();

        $createLibraryUseCase = $this->app->make(CreateLibraryUseCaseInterface::class);
        $createLibraryUseCase->handle(
            new CreateLibraryInput(
                user: $this->user,
                name: 'sample_library',
                identificationCode: 'sample_library',
            )
        );

        $registerBookUseCase = $this->app->make(RegisterBookUseCaseInterface::class);
        $registerBookUseCase->handle(
            new RegisterBookInput(
                user: $this->user,
                libraryCode: 'sample_library',
                title: 'はらぺこあおむし',
                isbn: '978-4033280103',
                author: '',
                publisher: '',
            )
        );

        $borrowBookUseCase = $this->app->make(BorrowBookUseCaseInterface::class);
        $borrowBookUseCase->handle(
            new BorrowBookInput(
                user: $this->user,
                libraryCode: 'sample_library',
                isbn: '978-4033280103',
            )
        );

        $bookStockEloquent = BookStock::first();
        $bookStockEloquent->current_stocks--;
        $bookStockEloquent->save();
    }

    public function testHttpSuccess(): void
    {
        $response = $this
            ->postJson(
                uri: '/api/book/return',
                data: [
                    'libraryCode' => 'sample_library',
                    'isbn' => '978-4033280103',
                ],
            );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                ],
            ]);
    }
}
