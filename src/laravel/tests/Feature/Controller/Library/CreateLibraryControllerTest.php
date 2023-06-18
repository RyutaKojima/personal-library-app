<?php

declare(strict_types=1);

namespace Tests\Feature\Controller\Library;

use Packages\Exceptions\DataNotFoundException;
use Tests\FeatureUtil\Authenticate;
use Tests\TestCase;

final class CreateLibraryControllerTest extends TestCase
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
            ->postJson('/api/library/create', [
                'name' => 'セイルボート図書館(広島)',
                'identification_code' => 'sailboat-hiroshima',
            ]);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'name' => 'セイルボート図書館(広島)',
                    'identificationCode' => 'sailboat-hiroshima',
                ],
            ]);
    }
}
