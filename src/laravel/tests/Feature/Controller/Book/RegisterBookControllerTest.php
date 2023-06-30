<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Book;

use App\Models\Book;
use Packages\UseCases\Library\Create\CreateLibraryInput;
use Packages\UseCases\Library\Create\CreateLibraryUseCaseInterface;
use Tests\AuthorizedTestCase;

final class RegisterBookControllerTest extends AuthorizedTestCase
{
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
    }

    public function testHttpSuccess(): void
    {
        // 未登録図書の追加
        $response = $this
            ->postJson(
                uri: '/api/book/register',
                data: [
                    'libraryCode' => 'sample_library',
                    'title' => 'はらぺこあおむし',
                    'isbn' => '978-4033280103',
                    'author' => '',
                    'publisher' => '',
                ],
            );

        $bookEloquent = Book::firstOrFail();

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'bookId' => $bookEloquent->id,
                    'title' => 'はらぺこあおむし',
                    'isbn' => '978-4-03-328010-3',
                    'author' => '',
                    'publisher' => '',
                    'currentStocks' => 1,
                    'maxStocks' => 1,
                ],
            ]);

        // 既存図書の追加
        $response = $this
            ->postJson(
                uri: '/api/book/register',
                data: [
                    'libraryCode' => 'sample_library',
                    'title' => 'はらぺこあおむし',
                    'isbn' => '978-4033280103',
                    'author' => '',
                    'publisher' => '',
                ],
            );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'bookId' => $bookEloquent->id,
                    'title' => 'はらぺこあおむし',
                    'isbn' => '978-4-03-328010-3',
                    'author' => '',
                    'publisher' => '',
                    'currentStocks' => 2,
                    'maxStocks' => 2,
                ],
            ]);
    }
}
