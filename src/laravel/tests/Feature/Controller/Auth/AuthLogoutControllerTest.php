<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Auth;

use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class AuthLogoutControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Authenticate::makeDummyUser($this->app);
        $this->token = Authenticate::login($this->app);
    }

    public function testHttpSuccess(): void
    {
        $response = $this->postJson(
            '/api/auth/logout',
            [
            ],
            [
                'Authorization' => "Bearer {$this->token}",
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [],
            ]);
    }
}
