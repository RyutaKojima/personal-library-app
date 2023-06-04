<?php

declare(strict_types=1);

namespace Packages\Domains\User;

final class Password
{
    private function __construct(
        public readonly string $passwordHash,
        public readonly string|null $passPhrase = null,
    ) {
    }

    public static function makeByPhrase(string $passPhrase): self
    {
        return new self(self::hash($passPhrase), $passPhrase);
    }

    public static function makeByHash(string $hash): self
    {
        return new self($hash);
    }

    public function verify(Password $password): bool
    {
        if ($password->passPhrase === null) {
            return false;
        }
        return password_verify($password->passPhrase, $this->passwordHash);
    }

    public static function hash(string $passPhrase): string
    {
        return password_hash($passPhrase, PASSWORD_DEFAULT);
    }
}
