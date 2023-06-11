<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\User;

use Packages\Exceptions\DataNotFoundException;
use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class GetUserMeControllerTest extends TestCase
{
    /**
     * @throws DataNotFoundException
     */
    public function setUp(): void
    {
        parent::setUp();

        Authenticate::makeDummyUser($this->app);
        $this->token = Authenticate::login($this->app);
    }

    public function testHttpSuccess(): void
    {
        $response = $this
            ->getJson(
                '/api/user/me',
                [
                    'Authorization' => "Bearer {$this->token}",
                ]
            );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'accountId' => Authenticate::TEST_ACCOUNT_ID,
                    'name' => Authenticate::TEST_NAME,
                ],
            ]);
    }
}
