<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Auth;

use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class AuthLoginControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Authenticate::makeDummyUser($this->app);
    }

    /**
     * A basic feature test example.
     */
    public function testHttpSuccess(): void
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'account_id' => Authenticate::TEST_ACCOUNT_ID,
                'password' => Authenticate::TEST_PASSWORD,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                ]
            ]);
    }
}
