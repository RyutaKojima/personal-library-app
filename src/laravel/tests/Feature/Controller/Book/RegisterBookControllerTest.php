<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Book;

use Packages\Exceptions\DataNotFoundException;
use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class RegisterBookControllerTest extends TestCase
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
        $response = $this
            ->getJson(
                uri: '/api/xxx',
            );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                ],
            ]);
    }
}
