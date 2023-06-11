<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Cache;
use Packages\Domains\Auth\AuthTokenRepositoryInterface;
use Packages\Domains\User\User;

final class AuthTokenRepository implements AuthTokenRepositoryInterface
{
    private function makeCacheKeyByUser(User $user): string
    {
        return 'auth-user-to-token-' . $user->accountId;
    }

    private function makeCacheKeyByToken(string $token): string
    {
        return 'auth-token-to-user-' . $token;
    }

    public function getTokenByUser(User $user): string
    {
        $key = $this->makeCacheKeyByUser($user);
        return Cache::get($key, '');
    }

    public function getAccountIdByToken(string $token): string
    {
        $key = $this->makeCacheKeyByToken($token);
        return Cache::get($key, '');
    }

    public function set(
        User $user,
        string $token,
        int $minutesUntilExpiration = self::MINUTES_UNTIL_EXPIRATION,
    ): void {
        $ttl = now()->addMinutes($minutesUntilExpiration);

        Cache::put(
            key: $this->makeCacheKeyByUser($user),
            value: $token,
            ttl: $ttl,
        );

        Cache::put(
            key: $this->makeCacheKeyByToken($token),
            value: $user->accountId,
            ttl: $ttl,
        );
    }

    public function clear(User $user): void
    {
        $token = $this->getTokenByUser($user);
        Cache::forget($this->makeCacheKeyByUser($user));
        Cache::forget($this->makeCacheKeyByToken($token));
    }
}
