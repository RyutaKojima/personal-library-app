<?php

declare(strict_types=1);

namespace Tests;

use Packages\Domains\User\User;
use Packages\Exceptions\DataNotFoundException;
use Tests\FeatureUtil\Authenticate;

abstract class AuthorizedTestCase extends TestCase
{
    protected User $user;
    protected string $token;

    /**
     * @throws DataNotFoundException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = Authenticate::makeDummyUser($this->app);
        $this->token = Authenticate::login($this->app);
        $this->withHeader('Authorization', "Bearer {$this->token}");
    }
}
