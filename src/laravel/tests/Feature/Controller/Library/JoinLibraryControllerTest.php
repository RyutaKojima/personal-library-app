<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Library;

use App\Models\Library;
use Packages\Exceptions\DataNotFoundException;
use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class JoinLibraryControllerTest extends TestCase
{
    /**
     * @throws DataNotFoundException
     */
    public function setUp(): void
    {
        parent::setUp();

        Authenticate::makeDummyUser($this->app);
        $this->token = Authenticate::login($this->app);
        $this->withHeader('Authorization', "Bearer {$this->token}");
    }

    public function testHttpSuccess(): void
    {
        Library::factory()
            ->make([
                'identification_code' => 'library_code',
            ])
            ->save();

        $response = $this
            ->postJson(
                uri: '/api/library/join',
                data: [
                    'identification_code' => 'library_code',
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
