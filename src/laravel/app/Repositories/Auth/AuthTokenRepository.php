<?php

declare(strict_types=1);


namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Cache;
use Packages\Domains\Auth\AuthTokenRepositoryInterface;
use Packages\Domains\User\User;

final class AuthTokenRepository implements AuthTokenRepositoryInterface
{
    private function makeCacheKey(User $user): string
    {
        return "auth-token-" . $user->accountId;
    }

    public function get(User $user): string
    {
        return Cache::get($this->makeCacheKey($user));
    }

    public function set(
        User $user,
        string $token,
        int $minutesUntilExpiration = self::MINUTES_UNTIL_EXPIRATION,
    ): void {
        Cache::put(
            key: $this->makeCacheKey($user),
            value: $token,
            ttl: now()->addMinutes($minutesUntilExpiration),
        );
    }

    public function clear(User $user): void
    {
        Cache::forget($this->makeCacheKey($user));
    }
}
