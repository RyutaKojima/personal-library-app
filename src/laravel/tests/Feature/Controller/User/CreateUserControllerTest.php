<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\User;

use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class CreateUserControllerTest extends TestCase
{
    public function testHttpSuccess(): void
    {
        $response = $this->postJson(
            '/api/user/signup',
            [
                'account_id' => Authenticate::TEST_ACCOUNT_ID,
                'password' => Authenticate::TEST_PASSWORD,
                'name' => Authenticate::TEST_NAME,
            ],
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'accountId' => Authenticate::TEST_ACCOUNT_ID,
                    'name' => Authenticate::TEST_NAME,
                ]
            ]);
    }
}
